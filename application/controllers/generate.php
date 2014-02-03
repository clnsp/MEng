<?php
class Generate extends CI_Controller{

	/**
	* Populate the database with random classes
	* @param int - number of classes to generate
	* @param int - offset time in seconds from now to start generating
	* @param int - number of months to generate classes for
	* 
	*/
	function classes($numberClasses = 0, $offset = 0, $months = 1){
		
		if($numberClasses > 0){
			$this->load->model('classes');
			$this->load->model('rooms');

		// Get all the class types
			$classTypes = $this->classes->getClassTypeIDs();
			$maxCTindex = count($classTypes)-1;

		//get all the room ids
			$roomIds = $this->rooms->getRoomIDs();
			$maxRindex = count($roomIds)-1;


			$now = time() + $offset;		

			for ($i = 1; $i <= $numberClasses; $i++) {

			//select random class type
				$class_type_id = $classTypes[rand(0, $maxCTindex)]['class_type_id'];

			//start and end date one hour apart
				$randtime = $now + rand(30, 60 * 60 * 24 * 30 * $months);
				$class_start_date = date('Y-m-d H:0:0',  $randtime);
				$class_end_date = date('Y-m-d H:0:0', $randtime + (60*60));

			//max attendance random no. between 5 and 50
				$max_attendance = rand(5, 50);
				$max_attendance = $max_attendance - ($max_attendance%10);

			//select random room
				$room_id = $roomIds[rand(0, $maxRindex)]['room_id'];


				echo $i . 'Inserting: class_type_id: ' . $class_type_id . ' start: '. $class_start_date . ' end: ' .  $class_end_date  . ' room_id: ' . $room_id . ' max_attendance: '. $max_attendance .  ' cancelled: 0' . "<br/>";

				$data = array(
					'class_type_id' => $class_type_id ,
					'class_start_date' => $class_start_date ,
					'class_end_date' => $class_end_date ,
					'room_id' => $room_id,
					'max_attendance' => $max_attendance,
					'cancelled' => 0,
					);

				$this->classes->insertClass($data);

			}

		}
		else{
			echo "No classes added. Supply a number of months to generate.";
		}

	}
	
	
	/**
	* Populate the database with realistic users pulled from a text file.
	* They will have random membership types
	* @param int - number of people to generate
	* 
	*/
	function people($number = 0){

		if($number > 0){
			$this->load->model('tank_auth/users');
			$this->load->model('members');
			$this->load->library('tank_auth');

			$membershipTypes = $this->members->getMembershipTypes();
			$maxMShipindex = count($membershipTypes)-1;

			$people = file(base_url() . 'assets/text/sports_people.txt');
			$max_people = count($people)-1;

			shuffle($people); //shuffle array

			foreach ($people as $person_num => $person) {	

				if($person_num == $number){
					echo('exiting');
					break;
				}

				$parts = explode(" ", $person);
				$lastname = str_replace("\n", "", array_pop($parts));
				$firstname = implode(" ", $parts);
				$username = preg_replace('/( *)/', '', $firstname.$lastname);
				$email =  $username.'@mailnesia.com';

				if(!$this->tank_auth->is_email_available($email)){
					echo 'skipped ' . $username . ', already in database</br>';
					continue;
				}

				$hasher = new PasswordHash(
					$this->config->item('phpass_hash_strength', 'tank_auth'),
					$this->config->item('phpass_hash_portable', 'tank_auth')
					);
				$hashed_password = $hasher->HashPassword($username);

				$membership_type_id = $membershipTypes[rand(0, $maxMShipindex)]['id'];
				$email =  $username.'@mailnesia.com';

				$data = array(
					'first_name'=>$firstname,
					'second_name'=>$lastname,
					'password'=>$hashed_password,
					'membership_type_id'=> $membership_type_id ,
					'email'=> $email,      		    	
					);

				$this->users->create_user($data);

				echo $person_num . ' added first: [' . $firstname . '] last: [' . $lastname  . '] member_type: ' . $membership_type_id . ' email: ' .  $email . ' pass: ' . $hashed_password . '</br>';

			}

		}
		else{
			echo "No sports people added. Supply a number of users to generate.";
		}

	}


}?>