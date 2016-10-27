<?php

	class MembershipTest extends Membership {

		protected $user;
		protected $id = 67863;
		protected $username = Aden;
		protected $orgid = 1298;

		protected function setUp() {
			$this->$user = new Membership();
		}

		public function testGetIdFromUsername() {
			$this->assertEquals("Aden", ($this->$user->get_id($username));
		}

		public function testGetOrgIdFromUsername() {
			$this->assertEquals(1298, ($this->$user->get_org_id($id)));
		}

		public function testGetOrgNameFromOrgid() {
			$this->assertEquals("Cancer Council Australia", ($this->$user->$get_org_name($orgid)));
		}

		public function testGetOrgInfoArrayFromId() {
			$org_array = ($this->$user->$get_org(1337);
			$this->assertEquals("Word Wildlife Federation", $org_array[0]);
			$this->assertEquals("For everything else theres mastercard", $org_array[1]);
			$this->assertEquals(1, $org_array[2]);
			$this->assertEquals("Matt Damon", $org_array[3]);
			$this->assertEquals("word", $org_array[4]);
		}

		public function testGetOrgInfoArrayFromIdFailure() {
			$this->assertEquals("FAILURE", ($this->$user->$get_org(1234)));
		}

		public function testGetEventListFromOrgIdNotEmpty(){
			$listnotempty = false;
			$event_array = $this->$user->get_event_list($orgid);
			if (count($event_array) != 0) {
				$listnotempty = $true;
			} else {
				$listnotempty = $false;
			}

			$this->assertTrue($listnotempty);

		}

		public function testGetEventListFromOrgIdFailure() {
			$this->assertEquals("FAILURE", ($this->$user->$get_event_list(1234)));
		}

		public function testGetEventListUserCreatedFromUserIdNotEmpty() {
			$listnotempty = false;
			$event_array = $this->$user->get_event_list_user_id($id);
			if (count($event_array) != 0) {
				$listnotempty = $true;
			} else {
				$listnotempty = $false;
			}

			$this->assertTrue($listnotempty);
		}

		public function testGetEventListUserCreatedFromUserIdFailure() {
			$this->assertEquals("FAILURE", $this->$user->$get_event_list_user_id(0));
		}

		public function testGetEventInformationFromEventId() {
			$listnotempty = false;
			$eventinfo_array = $this->$user->get_event_list_user_id(78691);
			if (count($eventinfo_array) != 0) {
				$listnotempty = $true;
			} else {
				$listnotempty = $false;
			}

			$this->assertTrue($listnotempty);
		}

		public function testGetEventInformationFromEventIdFailure() {
			$this->assertEquals("FAILURE: Unable to pull event information", $this->$user->get_event_information(0));
		}

		public function testGetUserSpecInfoFromUserId() {
			$listnotempty = false;
			$userinfo_array = $this->$user->get_spec_info($id);
			if (count($userinfo_array) != 0) {
				$listnotempty = $true;
			} else {
				$listnotempty = $false;
			}

			$this->assertTrue($listnotempty);
		}

		public function testGetUserSpecInfoFromUserIdFailure() {
			$this->assertEquals("FAILURE", $this->$user->get_spec_info(0));
		}

		public function testUpdateDetailsTrue() {
			$this->assertTrue($this->$user->$update_details($id,"Mr","Aden","CoolDude","Smith","12345678","5 man drive","5/6/1990","Male","mail@hotmail.com","Bus Driver"));
		}

		public function testUpdateDetailsFalse() {
			$this->assertFalse($this->$user->$update_details(0,0,0,0,0,0,0,0,0,0,0));
		}

		public function testRegisterUserTrue() {
			$this->assertTrue($this->$user->$register_user("XXSniperXX","super", "1298"));
		}

		public function testRegisterUserFalse() {
			$this->assertFalse($this->$user->$register_user(0,0,0));
		}

	}

?>