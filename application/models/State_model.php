<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class State_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    function showStates(){
        $this->db2 = $this->load->database('state', TRUE);
        $tables = $this->db2->list_tables();
        return $tables;

    }
    function checkTable($table){
        $this->db2 = $this->load->database('state', TRUE);
        return $tables = $this->db2->table_exists($table);
        
    }


    function userListingCount($searchText = '')
    {
        $this->db2 = $this->load->database('state', TRUE);
        $this->db2->select('city_id, city, school_list');
        $this->db2->from('jharkhand');
        $this->db2->where('isDeleted', 0);
        $this->db2->where('roleId !=', 1);
        $query = $this->db2->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        $this->db2 = $this->load->database('state', TRUE);
        $this->db2->select('city_id, city, school_list');
        $this->db2->from('jharkhand');
        $this->db2->where('isDeleted', 0);
        $this->db2->where('roleId !=', 1);
        $query = $this->db2->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    /*$this->db2 = $this->load->dbforge();
        $fields = array(
                        'city_id' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => 255,
                                                 'auto_increment' => TRUE
                                          ),
                        'city' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                          ),
                        'school_list' => array(
                                                 'type' =>'text',
                                                 'constraint' => '1000',
                                          ),
                );
        $this->db2 = $this->dbforge->add_field($fields);
        $this->db2 = $this->dbforge->add_key('city_id', TRUE);
        $this->db2 = $this->dbforge->create_table('new', TRUE);
        */
    function addNewState($stateName)
    {
        $this->db2 = $this->load->database('state', TRUE);

           $state_list= $this->showStates();
            //print_r($state_list);
                $flag=0;
                foreach ($state_list as $value) {
                    //echo $stateName;
                    if($value==$stateName)
                    {
                        $flag=0;
                        break;
                    }
                    else
                    {
                        $flag=1;
                    }
                }

               // echo $flag;
                if($flag==0)
                {
                    return 0;
                }
                else
                {
                    $sql = "CREATE TABLE IF NOT EXISTS ".$stateName." (
          city_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
          city VARCHAR(30) NOT NULL,
          school_list text NOT NULL
          )";
            $query = $this->db2->query($sql);
            return $query;
                }
           
        
        
    }

    function addNewStates($userInfo)
    {
        $this->db2 = $this->load->database('state', TRUE);
        
        $this->db2->insert('jharkhand', $userInfo);
        
        $insert_id = $this->db2->insert_id();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db2 = $this->load->database('state', TRUE);
        $this->db2->select('city_id, city, school_list');
        $this->db2->from('jharkhand');
        $this->db2->where('isDeleted', 0);
        $this->db2->where('roleId !=', 1);
        $this->db2->where('city_id', $userId);
        $query = $this->db2->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db2 = $this->load->database('state', TRUE);
        $this->db2->where('city_id', $userId);
        $this->db2->update('jharkhand', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db2 = $this->load->database('state', TRUE);

        $this->db2->where('city_id', $userId);
        $this->db2->update('jharkhand', $userInfo);
        
        return $this->db2->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  