<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Cerebramodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		{
			$this->load->database();
			$this->load->helper('url');
			$this->load->helper('date');

		}
	}
function initialize($kid){
		$q="SELECT kid from k13_cerebra where kid=?";
		$res=$this->db->query($q,$kid);
		if($res->num_rows()>0)
			return;
		else
		{//set initial value in database.
			$query1="Select fullname from bitauth_userdata where kid=?";
			$result1=$this->db->query($query1,$kid);
			foreach($result1->result() as $row1)
				$name=trim($row1->fullname);		
//////////////////////////////////////////////////////
			$qid=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40);
			
			for($value=1;$value<count($qid);$value++) 
			{
			$this->db->insert('k13_cerebra',array('kid'=>$kid,'qid'=>$qid[$value],'attempt'=>0,'flag'=>0));
			}

		$this->db->insert('cerebra_users',array('kid'=>$kid,'name'=>$name,'points'=>0,'answered'=>0));	

			
			//fb post..
		}
	}

public function getques($kid)
{
	$q1="select points,answered from cerebra_users where kid=?";
	$r1= $this->db->query($q1,$kid);
	$rr1   = $r1->row();
	
	
		$q2    = "select qid,attempt,flag from k13_cerebra where kid=?";
		$r2    = $this->db->query($q2,$kid);
		$rr2   = $r2->row();
		$qid=array();
		$qa=array();
		$qw=array();
		$i=1;
		foreach($r2->result() as $row)
			$qid[$i++]=$row->qid;

	$i=1;
		//$qa    = $rr2->flag;
		//$qw    = $rr2->attempt;
		foreach($r2->result() as $row)
			{
				$qa[$i]=$row->flag;
				$qw[$i] = $row->attempt;
				$i++;
			}
				


	$ques= array("cerebra-test1",

		"You are provided with 1000 chalk pieces. You
	are supposed to pick out some number of chalk pieces such that, the count
	of chalk, when divided by all the numbers from 2 to 9, except 7, will
	leave a 0 remainder, when one of the chalk pieces is removed before
	dividing. One constraint is that, you have to choose a minimum of 500
	chalk pieces. Can you guess the count?",

"A round table conference is to be held and 4 gents and 2 ladies were supposed to attend the conference. 
As we all know, ladies when stick together will chitchat and end up in fight. 
So, the two ladies were not allowed to sit together. 
How many such possible arrangements can be made around the table?",

"Any mechanical clock has gears that make the hour and minute hands move in coordination 
with each other. The minute gear is designed in such a way that it 
drives the hour gear. Suppose that, in a clock (not the usual 12hr clock) the 
radius of minute gear is 2.5cm and that of the hour gear is 4.8cm. 
By what degrees the minute gear should has rotated, 
if the hour gear has rotated through an angle of 117 degrees? (Round off to the nearest integer)",

"* If 1/7 of 20 is 4, then what is 1/6 of 14?",

"Decode the following message using a standard cipher:<br>hvxivgnvhhztv",

"Find the area of the shaded region:
<!----------------------------------------------------------------------->
<img src='http://kurukshetra.org.in/cerebra/assets/images/first.png'/>
The equilateral triangle is formed by joining the centres of the three circles of radii 7cm each.
 Find the area (in cm2) of the shaded region. (Format: Round off to the nearest integer)",

"Sheldon was fond of prime factors. He was wondering what will be the largest prime factor 
of todays date. Today’s date is 19/01/2014. 
Considering it to be a number (19012014), he wanted to know what the largest prime factor is.",

"Three numbers are in Arithmetic Progression, three other numbers are in geometric progression. 
Adding the corresponding terms of these two progressions successively, we obtain 65,60 and 67 
respectively and adding all the three terms in the arithmetic progression, we get 108. 
It is found that, the geometric progression has common ratio more than 1. 
Find the terms of both the progression. <br>
(FORMAT: three terms in A.P. followed by three terms in G.P. 
	eg. If 1,2 and 3 are in A.P. and 2,10,50 are in G.P, then answer should be 12321050)",

"* A circular plane needs to be divided into 172 distinct regions. 
To draw a line, it costs $76. If Rick is a miser and also someone with a good logical mind, 
how much money in $ would he have spent to achieve the target?",

"Melvin was sitting inside classroom and he found the class boring. 
He found some chocolates in his bag and began to eat them. 
He ate 2 chocolates and divided the remaining chocolates into two halves and 
gave it to two of his friends. His friends also, ate 2 of the chocolates and 
divided the remaining into two halves and passed onto their friends and this process 
went on like this. Assume that it takes 1 minute to eat the two chocolates and 
30 seconds to pass the chocolate. After 5 minutes and 30 seconds, all the chocolates 
were eaten up. How many chocolates were there initially?",

" If<br>2=2
	<br>6=4
	<br>9=10
	<br>16=2
	<br>24=4
	<br>62=?",

"Each letter in the cryptarithm ABBAAB/MNOP=BA uniquely represents a digit in the 
decimal scale (0-9). What decimal digits do the letters B and O represent? <br>
(Format: decimal equivalent of B  followed by decimal equivalent of O).",

"A runs at a speed of 5 metres per second. After 26 seconds, B started to run along the same 
path of A at a speed of 7 metres per second. After how many seconds from thereon, will B reach A?",

"* If  <br>45:20912
	<br>18:899
	<br>26:12801
	<br>65: ?",

"Decode:<br>
ijmqpbpwmi<br>
(HINT: You may need the question number)",

"Hogwarts express travelling towards Hogwarts overtakes a witch, traveling by 
broomstick at 10:00am in the morning. The express reaches Hogwarts at 11:30am and after an hour, 
it returns from Hogwarts, and meets the witch at 01:00pm. When will the witch reach 
Hogwarts? <br>(If the witch reaches at 05:00pm/am, answer format: 0500)",

"In 2009, the sum of the ages of a father and a son was 53. 
In 2001, the product of their ages was four times the age of the 
father in 2009. What is the current age of father and son?<br>
 (FORMAT: Father's age followed by son's age)",

"Viknesh was waiting for train in the railway station. 
Due to riot, all trains were cancelled and he had to spend more time in the railway station. 
There was a 24 hrs digital clock, which was 10 minutes fast, and a mirror next to it. 
Rather than looking directly at the clock, bored Viknesh preferred looking the 
image of time in the mirror. The mirror showed him 01:05. 
He took a nap and after waking up he saw the mirror again. 
It showed him 82:50. Find the actual amount of time (in seconds) spent while sleeping, 
if the clock was 10 minutes fast.",

"A man sees the photograph of a man and says 'This man's mother-in-law's son's only 
niece is my sister'. How is the man in the photograph related to the son of the man saying this?",

"Find the next term in the series:<br>
	10^3, 10^9, 10^12, 10^2, 10^0, __",	

"* Samuel, the bot, is standing in position A(1,1) of a 6 X 8 square grid . He is allowed to move either right or down. He is not allowed to move up or left. Also, he is not allowed to pass through C(5,5), as there is a hurdle. By how many possible ways, he can reach B(6,8) from A?<br>
<img src='http://kurukshetra.org.in/cerebra/assets/images/2.png'/>
 ",

"Anu can build a house in 8 days. After working for 2 days, she hires a helper and 
they both work together. After 4 days, the house is built. 
In how many days, the helper alone can build the house?",

"Mohan is always fond of Math Puzzles. 
He used to solve many such puzzles and ask the same to his dad. 
On a fine Sunday, Mohan was stuck with a puzzle and asked for his dad’s help. 
Brilliant dad cracked the puzzle and explained him how to solve such puzzles. 
Can you solve the same? <br>Here is the puzzle: <br>Sixty two less than square of the 
middle number among three odd positive consecutive integers is equal to the sum of smallest number and twenty times the largest number. Find all the three integers. Input your answer in ascending order of the three numbers.",

"A cube of side 10cm is painted with different colour on all the six sides.
 It is then broken down into identical smaller cubes of side 2cm each. 
 We remove all the smaller cubes with exactly two faces coloured.
 From the leftovers, we remove all the smaller cubes with no faces coloured. 
 How many smaller cubes are remaining after removal?",

"A unique numbering system has only three letters: e,m and t. 
The first number in the system is e, second number is m, third number is t,  
fourth number is ee and so on, so that the series is e,m,t,ee,em,et,me,etc. 
Find the representation for the 69th number.",

"Decode the following message:<br>
-.-. . .-. . -... .-. .- 
",

"Alfred, the Chemist, had a machine that prepares acid solutions.
 The machine will remove certain amount of the acid from the beaker and replace 
 it with water, thereby preparing acid solution.It takes 4 minutes for the machine 
 to do this process. Initially 90 litres of acid is kept in the beaker. 
 The machine is now tuned to remove 10% of the liquid from the beaker and replace with water.
 If the machine is allowed to work for 16 minutes, how many litres of acid will be available in 
 the beaker after 16 minutes? (round off to the nearest integer)",

"*In a 24 hour clock, there are times when a digit appears in a group of 3 together, 
e.g. 0111. If you take these times on an analog clock, what is the sum of times when 
the angle from the hour hand to the minute hand, measured clockwise, is greater than 180 degrees? 
Also, exclude times when 12 lies within the angle. Sum the times as if they were numbers, e.g. 2000+1000=3000",

"* On a baseball diamond, the distances between the bases is exactly 100 ft. The catcher has to 
be able to make an accurate throw from home plate to second base. If the catcher throws the ball at 80 mph,
how many seconds, to the tenth place, will it take the ball to reach second base?", 

"Two people have some money each. If the first person, say A, gives Re.1 to the second person,
 say B, then A and B would have the same amount of money. On the other hand, if B gave A Rs.2, 
 then A would have 3 times B's money. How much money do A and B have? <br>
 (Answer as A's money followed by B`s)",

"Alex: 5x + 2y = 12<br>
Cindy: x+y = 4.<br>
If I say that only one of them is speaking the truth and also that x and y are positive
integers and that the true statement will give only one value for (x,y)[Order does not matter]. 
Find 8*(x+y)",


"Decode to get the name of a famous sports personality <br>
(Enter in lower case without any spaces)<br>
DOAMDIANAOERDRNGMOAA<br>
Clue: Use a standard cipher",

"Hari is a fond of coding. He was preparing for the reverse coding event of k!.
 So he randomly chose an executable file and tried to work with few testcases. 
 The code takes one integer as an input and produces one integer as output.
A few of the samples are: [format: &ltinput&gt &ltoutput&gt ]<br>
2 6<br>
4 18<br>
1 4<br>
3 12<br>
6 42 <br>
[expl: first sample takes 2 as input and produces 6 as output ]<br>
Find the product of outputs when inputs are given as 8 and 5.",

"A series of games were released at eight-year intervals. 
When the eighth game was released, the sum of the release years was 15512. 
When was the first game released?",

"Find the first 3 digit number which when divided by 11 gives the sum of the 
squares of its digits.",

"The marks of 5 students A, B, C, D and E in a test were 80,82,91,71 and 76 respectively.
 The marks were fed into a spreadsheet which gave the average after each mark was entered.
  If I say that the marks were entered in a random order and that the average was always 
  an integer, write the fourth and the fifth marks entered in same order without any spaces 
  in between. (Eg: If 82 and 91 are the fourth and fifth scores respectively, then type 8291)",

"If a is the smallest positive integer that 2000+a is the sum of the cubes of the first b natural numbers, then find a*b","* Vikki finally broke his piggy bank and found that he had coins of type 1 paise, 3 paise, 10 paise, 20 paise, 50 paise and 2 rupee.
1 rupee = 100 paise<br>
He wants to know how many ways sum of 4 rupee can be made using any number of coins .<br>
Remember that his piggy bank is huge and he has unlimited number of coins to make all kinds of combination. 
Answer for him.",

"A Christmas party was hosted by Professor Horace Slughorn on the evening of 20 December, 1996
in his office in Hogwarts School of Witchcraft and Wizardry for his favourite students.
Hermione Granger realised that there were 11 people(including her) sitting in the round 
dining table. Feeling bored she calculated the number of ways  these 11 people can be 
arranged to sit such that every member has different neighbours in each arrangement.
Can you answer how many such arrangements are possible ?",

"The probability that a student will pass the Math test is 3/4.
Find the probability  that exactly 2 of the 4 students who take the test 
will pass the test.Assume that each event(i.e. taking test) is independent.<br>
 (Round off the answer to 2 decimal places)."

					);

		$p     = $rr1->points;
		$answered     = $rr1->answered;//total no of questions answered.
		$totalquestions=count($ques)-1;
		date_default_timezone_set('Asia/Calcutta');
		$t=time();
		$rs = $this->db->query("select st_time from start_cerebra");
        $rem=0;
        if ($rs->num_rows() == 1) {
            $rrs     = $rs->row();
            $st_time = $rrs->st_time;
            $rem=$t-human_to_unix($st_time);
?>
<script type="text/javascript">
			var phptimestamp = "<? echo human_to_unix($st_time)+5400;?>";			
			 
		</script>
<?
            //$diff    = $t - $st_time;
            //$rem     = ($diff + 109899) - $t;
			$flag=1;
		}
		
	if($rem<=0){
			$msg="<h2>Please wait till 20:00 IST !!</h2></div>";
						$flag=0;
		}
		
		if($flag==1){
			if($rem>=5400)
			{
				$msg="<h2>Cerebra main contest ended !! </h2></div>";
				$flag=0;
			}
		}
		

				
					

		//	$time_dif=$t-human_to_unix($st_time);				
			///////////////////////////////////////////////////////////
			$totalques=count($ques);
			$code='</h2><div class="col-md-9 question">';
			
			
			if($totalquestions==$answered)
			{
				$code.="<h2>You have completed!!</h2>";
				$code.="</div>";
			}
			else if($flag==0){
				$code.=$msg;
			}
			
			else{
					$code.='<div id="fixed-div">
<div class="row"><div id="countdown"></div>
<div align="left" style="display:inline;">Points : &nbsp' . $p . '</div></div></div>
    <script>
    // set the date were counting down to

var target_date =new Date(phptimestamp*1000);
 
// variables for time units
var days, hours, minutes, seconds;
 
// get tag element
 
// update the tag with id "countdown" every 1 second
setInterval(function () {
 
    // find the amount of "seconds" between now and target
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;
 
    // do some time calculations
    
    seconds_left = seconds_left % 86400;
     
    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;
     
    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);
     if(minutes<=0 && hours==0)
 { 
if(seconds<=0) { location.reload(true); 
     document.getElementById("countdown").innerHTML="Time is Up !!" ; }
else document.getElementById("countdown").innerHTML="Time is  Running!!<br>"+ hours + "h: "+ minutes + "m: " + seconds + "s";
}
    // format countdown string + set tag value
if(seconds>=0 && minutes>0)
    document.getElementById("countdown").innerHTML = hours + "h: "+ minutes + "m: " + seconds + "s";  
 
}, 1000);
    </script><div id="mascot" class="col-md-4 col-md-offset-8 "></div></h3> 
			';
					for ($u = 1; $u <$totalques; $u++) {

				if ($qa[$u]==0) {
				$code .= '<br>
				<b>Question ' . $u . '</b>
				<div class="span6"><b>Attempts : </b>&nbsp;
				<div style="display:inline;">' . $qw[$u] . '</div></div>

<!------------------------------------------------------------------------------------------------------------------------------>
			<form name="unanswered' .$u. '" method="post" action="http://kurukshetra.org.in/cerebra/submit">
			<input type="hidden" name="level" value="' .$u. '"/>
			<br>' . $ques[$u] . '<br>
			<br>
			<input type="text" class="form-control input-lg" name="answer" id="t' . $u . '" placeholder="Your Answer Here!!" tab-index="'.$u.'"/>
			<br><button type="submit" class="btn btn-primary btn-lg" id="but'.$u.'" style="float:right;"  >Submit</button>
			</form>';
								} 

			else {
						$code .= '<br><br><div clas="span4" ><div class="well alert-success round">
									<b>Question ' . $u . '</b>
									<div class="span4"><b>Attempts : </b>&nbsp;
									<div id=athena_attempts_t' . $u . ' style="display:inline;">' . $qw[$u] . '</div></div>
									<div class="span4"><div id=qc' . $u . ' style="display:inline;">
									<strong>Answered Correctly!</strong></div><div id=qs' . $u . '></div></div></div></div>';
								}
					}
					
					
			}
			return $code;
	
	

}

public function getanswer($level,$answer,$kid)
{
	//return 10;
	$answer_arr=array
	("0",
		"721",
		"72",
		"225",
		"3",
		"secretmessage",
		"8",
		"150889",
		"533619122448",
		"1368",
		"30",
		"32",
		"76",
		"65",
		"301114",
		"helloworld",
		"0230",
		"4518",
		"24480",
		"grandfather",
		"4",
		"512",
		"16",
		"232527",
		"62",
		"meet",
		"cerebra",
		"59",
		"2999",
		"1.2",
		"75",
		"24",
		"diegoarmandomaradona",
		"2160",
		"1911",
		"550",
		"7180",
		"225",
		"57273",
		"5",
		"0.21");
	
		date_default_timezone_set('Asia/Calcutta');
	 $t  = time();


        $rs = $this->db->query("select st_time from start_cerebra");
        if ($rs->num_rows() == 1) {
            $rrs     = $rs->row();
            $st_time = $rrs->st_time;
            $diff    = $t - human_to_unix($st_time);
            if ($diff > 5400)
                return ;
                }

		if(trim($answer)==null) return;
		
		else{
		
		 $this->db->select('points,answered');
		$r1 = $this->db->get_where('cerebra_users',array('kid'=>$kid));
	//	$q1="select points,answered from cerebra_users where kid='$kid'";
		//$r1= $this->db->query($q1);
		$rr1   = $r1->row();
			 $this->db->select('qid,attempt,flag');
			 $r2 = $this->db->get_where('k13_cerebra',array('kid'=>$kid));
		
		//$r2    = $this->db->query($q2);
		$rr2   = $r2->row();
		$qid=array();
		$i=1;
		foreach($r2->result() as $row)
			$qid[$i++]=$row->qid;



		$i=1;
		$qa=array();
		$qw=array();
		//$qa    = $rr2->flag;
		//$qw    = $rr2->attempt;
		foreach($r2->result() as $row)
			{
				$qa[$i]=$row->flag;
				$qw[$i] = $row->attempt;
				$i++;
			}
		
		$p     = $rr1->points;
		$answered     = $rr1->answered;
			if(strcmp(($answer),$answer_arr[$level])==0)
			{

				$p=$p+3;
				$answered=$answered+1;
///////////////////////////////////////////////
				$this->db->update('k13_cerebra', array('flag'=>1), array('kid' => $kid,'qid'=>$qid[$level]));
				//$qq = "update k13_cerebra set flag='1' where kid='$kid' and qid='$level'";
                //$this->db->query($qq);
                $this->db->update('cerebra_users', array('points'=>$p,'answered'=>$answered), array('kid' => $kid));
                //$ar = "update cerebra_users set points='$p',answered='$answered' where kid='$kid'";
                //$this->db->query($ar);

              }
			else
			{
				
				$attempt=$qw[$level];
				$attempt=$attempt+1;
				$p=$p-1;
				$this->db->update('k13_cerebra', array('attempt'=>$attempt), array('kid' => $kid,'qid'=>$level));
				$this->db->update('cerebra_users', array('points'=>$p), array('kid' => $kid));
				//$qq = "update k13_cerebra set attempt='$attempt' where kid='$kid' and qid='$level'";
				//$ar = "update cerebra_users set points='$points' where kid='$kid'";
				//$this->db->query($qq);
				//$this->db->query($ar);
			}
			
	}
}
}
