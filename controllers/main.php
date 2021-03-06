  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	private $cms_db;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('bitauth');

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('gravatar_helper');
		$this->load->helper('kimage_helper');
		$this->load->model('cerebramodel');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->load->library('session');
		$this->db = $this->load->database('default',TRUE);
//		$this->cms_db = $this->load->database('cms',TRUE);
		
	}


	public function leaderboard()
	{
		
		
		$result=$this->db->query('SELECT kid,name,points from cerebra_users ORDER BY points DESC LIMIT 0,15');

		if($this->bitauth->logged_in())
		{
			$data['logged_in']=1;
			$ret=$this->session->all_userdata();
			$logged_details=$this->bitauth->get_user_by_id($ret['ba_user_id']);
			$data['log']=$logged_details;
			$data['count']= $this->db->count_all('cerebra_users');
			$rank=1;
			$user_id=$this->db->query('SELECT * from cerebra_users ORDER BY points DESC');
			//echo $count;
			foreach($user_id->result() as $detail)
				{
					//echo strcmp($logged_details->kid,$detail->kid);
					if(strcmp($logged_details->kid,$detail->kid)!=0)
						{
							$rank=$rank+1;
						}
				else
					break;
				}
			$data['rank']=$rank;
			$data['id']=$result->result();
			$this->load->view('_template/head/doctype');
			$this->load->view('_template/head/html-start');
			$this->load->view('_template/head/scripts');
			$this->load->view('_template/head/head-start');
			$this->load->view('_template/head/meta-tags');
			$this->load->view('_template/head/head-end');
			$data['title']="Cerebra'14";
			$this->load->view('_template/head/styles');
			$this->load->view('_template/basic/cerebra_navigation',$data);
			$this->load->view('_template/basic/leader',$data);
			$this->load->view('_template/head/body-end');
			$this->load->view('_template/head/html-end');
		}
		else
		redirect(base_url());
	}


public function index()
{
	
$data['logged_in'] = 0;
		
		//$data['galleries'] = $this->mainmodel->getgalleries();
		$data['updates'] = 0;
		if($this->bitauth->logged_in())
		{
			// $this->session->set_userdata('redir', current_url());
			// redirect('auth/login');
			///////////////////////////////////////////////SESSION DETAILS
        	$ret=$this->session->all_userdata();
        	$logged_details=$this->bitauth->get_user_by_id($ret['ba_user_id']);
        	$data['log']=$logged_details;
        	// echo '<pre>';
        	// print_r($data['log']);
        	// echo '</pre>';
        	////////////////////////////////////////END OF SESSION DETAILS
        	$data['logged_in'] = 1;
		}
		//echo $logged_details;
			$data['title']="Cerebra'14";
			$data['welcome']="Welcome to Cerebra";
			$this->load->view('_template/head/doctype');
			$this->load->view('_template/head/html-start');
			$this->load->view('_template/basic/cerebra_meta');
			$this->load->view('_template/head/styles');
			$this->load->view('_template/head/head-start');
			$this->load->view('_template/head/title',$data);
			$this->load->view('_template/head/scripts');
			$this->load->view('_template/head/head-end');
			$this->load->view('_template/head/body-start');
			$this->load->view('_template/basic/cerebra_navigation',$data);
			$this->load->view('_template/basic/cerebrawelcome',$data);
			$this->load->view('_template/head/body-end');
			$this->load->view('_template/head/html-end');

}



public function play()
{
	
	if($this->bitauth->logged_in())
		{
		$ret=$this->session->all_userdata();
		$logged_details=$this->bitauth->get_user_by_id($ret['ba_user_id']);
		//echo $logged_details->fullname;
		$data['log']=$logged_details;
		     	$data['logged_in'] = 1;
		$this->load->model('cerebramodel');
		$this->cerebramodel->initialize($logged_details->kid);
		$data['centerDiv']=$this->cerebramodel->getques($logged_details->kid);
		$data['title']="Cerebra";
			
			$data['welcome']="Welcome to Cerebra";
			$this->load->view('_template/head/doctype');
			$this->load->view('_template/head/html-start');
			$this->load->view('_template/basic/cerebra_meta');
			$this->load->view('_template/head/styles');
			$this->load->view('_template/head/head-start');
			$this->load->view('_template/head/title',$data);
			$this->load->view('_template/head/scripts');
			$this->load->view('_template/head/head-end');
			$this->load->view('_template/head/body-start');
			$this->load->view('_template/basic/cerebra_navigation',$data);
			$this->load->view('questions',$data);
			$this->load->view('_template/head/body-end');
			$this->load->view('_template/head/html-end');
}

	else
		{
		redirect(base_url());
		}


}
 public function submit()
{
	if($this->bitauth->logged_in())
		{
		$ret=$this->session->all_userdata();
		//echo $ret[$ba_user_id];
		$logged_details=$this->bitauth->get_user_by_id($ret['ba_user_id']);
		echo $this->cerebramodel->getanswer($this->input->post('level'),$this->input->post('answer'),$logged_details->kid);
	}
   		redirect(base_url().'play');
          		          	

}


}	
