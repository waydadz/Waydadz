<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class State extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('state_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : States';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    */
    
    /**
     * This function is used to load the user list
     */
    function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->state_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 10 );
            
            //$data['userRecords'] = $this->state_model->userListing($searchText, $returns["page"], $returns["segment"]);
            $data['userRecords'] = $this->state_model->showStates($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Waydadz : State';
            
            $this->loadViews("states", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addState()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('state_model');
            //$data['roles'] = $this->state_model->getUserRoles();
            
            $this->global['pageTitle'] = 'Waydadz : Add New State';

            $this->loadViews("addState", $this->global, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewState()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('state','State Name','trim|required|max_length[128]');

            //$this->form_validation->set_rules('role','Role','trim|required|numeric');
            //$this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addState();
            }
            else
            {
                $state =strtolower($this->security->xss_clean($this->input->post('state')));
                //$roleId = $this->input->post('role');
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $userInfo = array('state'=>$state);
                
                $this->load->model('state_model');
                //$result = $this->state_model->checkTable($state);                
                $result = $this->state_model->addNewState($state);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New State created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'State already exist');
                }
                
                redirect('state/addState');
            }
        }
    }

    function addNewStates()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('cid','city id','trim|required|max_length[128]');
            $this->form_validation->set_rules('city','City','trim|required|max_length[128]');
            $this->form_validation->set_rules('slist','School List','required');

            //$this->form_validation->set_rules('role','Role','trim|required|numeric');
            //$this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addState();
            }
            else
            {
                $cid = ucwords(strtolower($this->security->xss_clean($this->input->post('cid'))));
                $city = $this->security->xss_clean($this->input->post('city'));
                $slist = $this->input->post('slist');

                //$roleId = $this->input->post('role');
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));
                
                $userInfo = array('city_id'=>$cid, 'city'=>$city, 'school_list'=> $slist);
                
                $this->load->model('state_model');
                $result = $this->state_model->addNewState($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New State created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('state/addState');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('state');
            }
            
            $data['roles'] = $this->state_model->getUserRoles();
            $data['userInfo'] = $this->state_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'Waydadz : Edit State';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('cid');
            
            $this->form_validation->set_rules('cid','City Id','trim|required|max_length[128]');
            $this->form_validation->set_rules('city','City','trim|required|max_length[128]');
            $this->form_validation->set_rules('slist','School List','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                /*$name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role'); */
                $cid = $this->security->xss_clean($this->input->post('cid'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $slist = $this->security->xss_clean($this->input->post('slist'));
                
                $userInfo = array();
                
                    $userInfo = array('city_id'=>$cid,
                        'city'=>$city, 'school_list'=>$slist, 'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->state_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('state');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->state_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Waydadz : Change Password';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Waydadz : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? $this->session->userdata("userId") : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 5, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Waydadz : User Login History';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
    }
}

?>