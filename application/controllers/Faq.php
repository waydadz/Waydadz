<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class faq extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('faq_model');
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
            
            $count = $this->faq_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 10 );
            
            $data['userRecords'] = $this->faq_model->userListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Waydadz : Help';
            
            $this->loadViews("faqs", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('faq_model');
            //$data['roles'] = $this->faq_model->getUserRoles();
            
            $this->global['pageTitle'] = 'Waydadz : Add New Faq';

            $this->loadViews("addfaq", $this->global, NULL);
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
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('question','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('answer','Password','required|max_length[20]');
            //$this->form_validation->set_rules('role','Role','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $question = ucwords(strtolower($this->security->xss_clean($this->input->post('question'))));
                //$roleId = $this->input->post('role');
                $answer = $this->security->xss_clean($this->input->post('answer'));
                
                $userInfo = array('question'=>$question, 'answer'=> $answer, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('faq_model');
                $result = $this->faq_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New FAQ created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'FAQ creation failed');
                }
                
                redirect('faq');
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
                redirect('userListing');
            }
            
            $data['roles'] = $this->faq_model->getUserRoles();
            $data['userInfo'] = $this->faq_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'Waydadz : Edit Help';
            
            $this->loadViews("editFaq", $this->global, $data, NULL);
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
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('question','question','trim|required|max_length[128]');
            $this->form_validation->set_rules('answer','Answer','trim|required|max_length[128]');
            //$this->form_validation->set_rules('role','Role','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $question = ucwords(strtolower($this->security->xss_clean($this->input->post('question'))));
                $answer = $this->security->xss_clean($this->input->post('answer'));
                //$roleId = $this->input->post('role');
                
                $userInfo = array();
                
               
                    $userInfo = array('question'=>$question, 'roleId'=>$roleId, 'answer'=>$answer, 'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
              
                
                $result = $this->faq_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Faq updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Faq updation failed');
                }
                
                redirect('/faq/editOld/'.$userId);
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
            
            $result = $this->faq_model->deleteUser($userId, $userInfo);
            
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