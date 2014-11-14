<?php
//include('Net/SSH2.php');

class DashboardController
extends BaseController
{
	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function getHome() {
		return View::make('dashboard/home');
	}

	public function getSettings() {
		return View::make('dashboard/settings');
	}

	public function getAddserver() {
		return View::make('dashboard/addserver');
	}
	
	public function getEditserver() {
		if (Request::segment(3)=='edit') {
			$server = Server::find(Request::segment(4));
			if (!$server) {
				echo 'ERROR: Server not found to edit';	
				die();
			}
			return View::make('dashboard/editserveredit')
				->with('name',$server->name)
				->with('id',$server->id)
				->with('usernames', Username::where('server_id', '=', $server->id)->get());
		}
		if (Request::segment(3)=='delete') {
			$server = Server::find(Request::segment(4));
			if (!$server) {
                                echo 'ERROR: Server not found to edit';
                                die();
                        }
			return View::make('dashboard/editserverdelete')->with('name',$server->name)->with('id',$server->id);
		}
		return View::make('dashboard/editserver')
			->with('servers', Server::all());
	}
	
	public function postAddserveradd() {
		$validation = Server::validate(Input::all());

		if ($validation->fails()) {
			return Redirect::to('dashboard/addserver')
				->withErrors($validation);
		}
		
		$name = Input::get('server');
		$servers = DB::table('servers')->where('name', $name)->get();
		if($servers)
			return Redirect::to('dashboard/addserver')
				->with('message', 'ERROR: ' . $name . ' already exists!');
		
		$server = new Server;
		$server->name = $name;
		$server->save();
		$username = new Username;
		$username->username = 'root';
		$username->server_id = $server->id;
		$username->save();
		return Redirect::to('dashboard/addserver')
			->with('message', $name . ' added successfully');	
	}

	public function postEditserveredit() {
		$id = Input::get('id');
		$server = Server::find($id);
		if (!$server) {
			echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
			die();
		}
		$validation = Server::validate(Input::all());
		if ($validation->fails()) {
			return Redirect::to('dashboard/editserver/edit/'.$id)->withErrors($validation);
		}
		$crons = Cron::where('hostname', '=', $server->name)->get();
		foreach ($crons as $cron)
			$cron->delete();
		DashboardController::syncServer($server);
		$server->name = Input::get('server');
		$server->save();
		return View::make('dashboard/editserversaved')->with('name', $server->name);
	}

	public function postEditservereditaddusername() {
		$id = Input::get('id');
		$server = Server::find($id);
                if (!$server) {
                        echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
		$validation = Username::validate(Input::all());
                if ($validation->fails()) {
                        return Redirect::to('dashboard/editserver/edit/'.$id)->withErrors($validation);
                }
		
		$username = new Username;
		$username->username = Input::get('username');
		$usernamealready = DB::table('usernames')->where('server_id', '=', $id)->where('username', '=', $username->username)->get();
		if($usernamealready)
			return Redirect::to('dashboard/editserver/edit/'.$id)
				->with('message', 'Username already exists for that server!');
		$username->server_id = $id;
		$username->save();
		return View::make('dashboard/editserveraddusernamesaved')
			->with('name', $server->name)
			->with('username', $username->username);
	}

	public function postEditserverdelete() {
		$server = Server::find(Input::get('id'));
		if (!$server) {
                        echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
		$name = $server->name;
		$usernames = Username::where('server_id', '=', $server->id);
		$crons = Cron::where('hostname', '=', $server->name)->get();
		foreach ($crons as $cron)
			$cron->delete();
		DashboardController::syncServer($server);
		$server->delete();
		foreach($usernames as $username)
			$username->delete();
		return View::make('dashboard/editserverdeletesuccess')->with('name',$name);
	}

	public function getEditserverusername() {
		if (Request::segment(3)=='delete')
			return View::make('dashboard/editserverusernamedelete')
				->with('serverID', Request::segment(4))
				->with('usernameID', Request::segment(5))
				->with('username', Username::find(Request::segment(5))->username)
				->with('servername', Server::find(Request::segment(4))->name);
		return 'Page not found';
	}
	
	public function postEditusernamedelete() {
		$server = Server::find(Input::get('serverID'));
                if (!$server) {
                        echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
		$username = Username::find(Input::get('usernameID'));
		if (!$username) {
                        echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
		$name = $username->username;
		$crons = Cron::where('hostname', '=', $server->name)->where('username', '=', $name)->get();
		foreach ($crons as $cron)
			$cron->delete();
		DashboardController::syncServer($server);
		$username->delete();
		return View::make('dashboard/editserverusernamedeletesuccess')->with('name',$name);
	}

	public function getCrons() {
		return View::make('dashboard/crons')->with('crons', Cron::all());
	}

	public function getCronsadd() {
		return View::make('dashboard/cronsadd')->with('servers', Server::all());
	}

	public function getCronslist() {
		return View::make('dashboard/cronslist')->with('servers', Server::all());
	}

	public function getCronslistlist() {
		if (Request::segment(3)=='edit') {
                        $cron = Cron::find(Request::segment(4));
                        if (!$cron) {
                                echo 'ERROR: Cron not found to edit';
                                die();
                        }
                       $serverid = DB::table('servers')->where('name', '=', $cron->hostname)->first();
			return View::make('dashboard/cronslistedit')
                                ->with('cron', $cron)
				->with('usernames', DB::table('usernames')->where('server_id','=', $serverid->id)->get());
                }
                if (Request::segment(3)=='delete') {
                        $cron = Cron::find(Request::segment(4));
                        if (!$cron) {
                                echo 'ERROR: Cron not found to edit';
                                die();
                        }
                        return View::make('dashboard/cronslistdelete')
				->with('cron', $cron);
                }
		$serverid = Request::segment(3);
                $server = Server::find($serverid);
                if (!$server) {
                                echo 'ERROR: Server not found to edit';
                                die();
                }
		return View::make('dashboard/cronslistlist')
			->with('crons', Cron::where('hostname', '=', $server->name)->get());
	}
	
	public function postCronslistlistedit() {
		$cron = Cron::find(Input::get('id'));
		if (!$cron) {
			echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
                $cron->min = Input::get('min');
                $cron->hour = Input::get('hour');
                $cron->day = Input::get('day');
                $cron->month = Input::get('month');
                $cron->dayofweek = Input::get('dayofweek');
                $cron->command = Input::get('command');
                $cron->username = Username::find(Input::get('username'))->username;
                $cron->save();

		$server = Server::where('name', '=', $cron->hostname)->first();
		DashboardController::syncServer($server);

		return View::make('dashboard/cronslisteditsuccess')
                        ->with('cron', $cron);
	}

	public function postCronslistlistdelete() {
		$cron = Cron::find(Input::get('id'));
                if (!$cron) {
                        echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
		$croninfo = $cron;
		$server = Server::where('name', '=', $cron->hostname)->first();
		$cron->delete();
		DashboardController::syncServer($server);
		return View::make('dashboard/cronslistdeletesuccess')
			->with('cron', $croninfo);
	}
	
	public function getCronsaddadd() {
		$id = Request::segment(3);
		$server = Server::find($id);
		if (!$server) {
                                echo 'ERROR: Server not found to edit';
                                die();
                }
		$scripts = explode("\n", DashboardController::getScriptsName($server));
                unset($scripts[count($scripts)-1]);
		return View::make('dashboard/cronsaddadd')
			->with('id', $id)
			->with('name', $server->name)
			->with('usernames', DB::table('usernames')->where('server_id','=',$id)->get())
			->with('scripts', $scripts);
	}

	public function postCronsaddadd() {
		$server = Server::find(Input::get('id'));
                if (!$server) {
                        echo 'OMG!!! Something went horribly wrong<br />Vince is a bad coder or you are very sneaky... or both!';
                        die();
                }
		
		$cron = new Cron;

		$cronarray = Input::get('data');
		$cronstring = $cronarray['User']['crontab'];

		$strlen = strlen( $cronstring );
		$nextvariable = 0;
		$buff = '';
		for( $i = 0; $i <= $strlen; $i++ ) {
			$char = substr( $cronstring, $i, 1 );
			if ($char == ' ') {
				switch ($nextvariable) {
					case 0:
						$cron->min = $buff;
						$buff = '';
						break;
					case 1:
						$cron->hour = $buff;
						$buff = '';
						break;
					case 2:
						$cron->day = $buff;
						$buff = '';
						break;
					case 3:
						$cron->month = $buff;
						$buff = '';
						break;
					case 4:
						$cron->dayofweek = $buff;
						$buff = '';
						break;
				}
				$nextvariable++;
			}
			$buff .= $char;
		}
		$cron->command = $buff;

		$cron->username = Username::find(Input::get('username'))->username;
		$cron->hostname = $server->name;
		$cron->save();

		DashboardController::syncServer($server);		

		return View::make('dashboard/cronsaddaddsuccess')
			->with('cron', $cron)
			->with('server', $server);
	}

	public function getSync() {
		if (Request::segment(3) == 'sync') {
			$id = Request::segment(4);
	                $server = Server::find($id);
        	        if (!$server) {
                                echo 'ERROR: Server not found to sync';
                                die();
			}
			DashboardController::syncServer($server);
			return View::make('dashboard/syncsuccess')
				->with('server', $server);
		}
		return View::make('dashboard/sync')
			->with('servers', Server::all());
	}
	
	public function getScripts() {
		return View::make('dashboard/scripts');
	}

	public function getScriptsadd() {
		return View::make('dashboard/scriptsadd')
			->with('servers', Server::all());
	}

	public function getScriptsaddadd() {
		$id = Request::segment(3);
                $server = Server::find($id);
                if (!$server) {
                                echo 'ERROR: Server not found to edit';
                                die();
                }
		return View::make('dashboard/scriptsaddadd')
			->with('server', $server);
	}

	public function postScriptsadd() {
		$server = Server::find(Input::get('id'));
		if (!$server)
			die('OMG! Something done broked!');
		
		$rules = array('name' => 'required', 'script' => 'required');	
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) 
			return View::make('dashboard/scriptsaddadd')
				->withErrors($validator->messages())
				->with('server', $server);	
		$script = Input::get('script');
		$scriptname = Input::get('name');
	
		DashboardController::syncScript($server, $script, $scriptname);

		return View::make('dashboard/scriptsaddsuccess')
			->with('name', $scriptname);
	}

	public function getScriptslist() {
		return View::make('dashboard/scriptslist')
			->with('servers', Server::all());
	}
	
	public function getScriptslistlist() {
		$server = Server::find(Request::segment(3));
                if (!$server) {
                	echo 'ERROR: Server not found! Stop using your back button or typing random crap into the url';
                        die();
                }	
		$scripts = explode("\n", DashboardController::getScriptsName($server));
		unset($scripts[count($scripts)-1]);
		return View::make('dashboard/scriptslistlist')
			->with('scripts', $scripts)
			->with('server', $server); 
	}

	public function getScriptsedit() {
		$number = Request::segment(4);
		$server = Server::find(Request::segment(3));
		if (!$server) {
                        echo 'ERROR: Server not found! Stop using your back button or typing random crap into the url';
                        die();
                }
		$name = DashboardController::getScriptName($server, $number);
		$script = DashboardController::getScript($server, $number);
		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
                if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret'))
                        die('Public Key Authentication Failed');
                $stream = ssh2_exec($connection, "rm scripts/'" . $name . "'");
		return View::make('dashboard/scriptsedit')
			->with('name', $name)
			->with('script', $script)
			->with('server', $server);
	}

	public function postScriptsedit() {
		$server = Server::find(Input::get('id'));
                if (!$server)
                        die('OMG! Something done broked!');

                $rules = array('name' => 'required', 'script' => 'required');
                $validator = Validator::make(Input::all(), $rules);

                if($validator->fails())
                        return View::make('dashboard/scriptsaddadd')
                                ->withErrors($validator->messages())
                                ->with('server', $server);
                $script = Input::get('script');
                $scriptname = Input::get('name');

                DashboardController::syncScript($server, $script, $scriptname);

                return View::make('dashboard/scriptsaddsuccess')
                        ->with('name', $scriptname);
	}

	public function getScriptsdelete() {
		$number = Request::segment(4);
                $server = Server::find(Request::segment(3));
                if (!$server) {
                        echo 'ERROR: Server not found! Stop using your back button or typing random crap into the url';
                        die();
                }
                $name = DashboardController::getScriptName($server, $number);
		return View::make('dashboard/scriptsdelete')->with('server', $server)->with('name', $name);
	}

	public function postScriptsdelete() {
		$server = Server::find(Input::get('id'));
                if (!$server)
                        die('OMG! Something done broked!');

		$scriptname = Input::get('name'); 
		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
                if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret'))
                        die('Public Key Authentication Failed');
                $stream = ssh2_exec($connection, "rm scripts/'" . $scriptname . "'");

		return View::make('dashboard/scriptsdeletesuccess')
                        ->with('name', $scriptname);

	}

	private function getScriptName($server, $number) {
		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
                if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret'))
                        die('Public Key Authentication Failed');
                $stream = ssh2_exec($connection, "ls -1 scripts");
                stream_set_blocking($stream, true);
		$output = explode("\n", stream_get_contents($stream));
                return $output[$number-1];
	}

	private function getScript($server, $number) {
		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
                if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret'))
                        die('Public Key Authentication Failed');
                $stream = ssh2_exec($connection, "ls -1 scripts");
                stream_set_blocking($stream, true);
                $output = explode("\n", stream_get_contents($stream));
		$filename = $output[$number-1];
		$stream = ssh2_exec($connection, "cat scripts/'" . $filename . "'");
		stream_set_blocking($stream, true);
		return stream_get_contents($stream);
	}

	private function getScriptsName($server){
		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
		if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret'))
	                die('Public Key Authentication Failed');
		$stream = ssh2_exec($connection, "ls -1 scripts");
		stream_set_blocking($stream, true);
		return stream_get_contents($stream);
	}

	private function syncScript($server, $script, $scriptname) {
		$file = $scriptname;

		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
                if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret'))
                        die('Public Key Authentication Failed');
                ssh2_exec($connection, 'rm scripts/' . $file);

		file_put_contents($file, $script);

		ssh2_scp_send($connection, $file, '/opt/ucron/scripts/' . $file, 0755);
	}

	private function syncServer($server) {
		$connection = ssh2_connect($server->name, 22, array('hostkey' => 'ssh-rsa'));
		if (!ssh2_auth_pubkey_file($connection, 'ucron', '/home/ucronadm/.ssh/id_rsa.pub', '/home/ucronadm/.ssh/id_rsa', 'secret')) 
			die('Public Key Authentication Failed');

		$usernames = Username::where('server_id', '=', $server->id)->get();
		foreach ($usernames as $username) {
			ssh2_exec($connection, './ctwrapper delete ' . $username->username );
			ssh2_exec($connection, 'rm newcrontab');
			$crons = Cron::where('username', '=', $username->username)->where('hostname', '=', $server->name)->get();
			foreach ($crons as $cron) {
				ssh2_exec($connection, 
					'echo "' . 
					$cron->min . ' ' .
					$cron->hour . ' ' .
					$cron->day . ' ' .
					$cron->month . ' ' .
					$cron->dayofweek . ' ' .
					$cron->command . 
					'" >> newcrontab');
			}
			ssh2_exec($connection, './ctwrapper replace ' . $username->username);
		}
	}
}
