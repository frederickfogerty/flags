<?php 
	header('Content-Type: application/json');
	$questions = array();
	$images_dir = "res/images/flags/";
	$flagsrc = array(
		'a' => $images_dir."a.png"
		, 'ap' => $images_dir."ap.gif"
		, 'ap_a' => $images_dir."ap_a.gif"
		, 'ap_h' => $images_dir."ap_h.gif"
		, 'b' => $images_dir."blue.jpg"
		, 'bl' => $images_dir."black.jpg"
		, 'c' => $images_dir."c.jpg"
		, 'd' => $images_dir."d.jpg"
		, 'fs' => $images_dir."firstsub.jpg"
		, 'i' => $images_dir."i.jpg"
		, 'l' => $images_dir."l.jpg"
		, 'las' => $images_dir."laser.png"
		, 'm' => $images_dir."m.jpg"
		, 'n' => $images_dir."n.jpg"
		, 'n_a' => $images_dir."n_a.png"
		, 'n_h' => $images_dir."n_h.png"
		, 'o' => $images_dir."o.jpg"
		, 'or' => $images_dir."orange.jpg"
		, 'p' => $images_dir."p.jpg"
		, 'p1' => $images_dir."p1.png"
		, 'p2' => $images_dir."p2.png"
		, 'p3' => $images_dir."p3.png"
		, 'p4' => $images_dir."p4.png"
		, 'p5' => $images_dir."p5.png"
		, 'p6' => $images_dir."p6.png"
		, 'r' => $images_dir."r.jpg"
		, 's' => $images_dir."s.jpg"
		, 'u' => $images_dir."u.jpg"
		, 'x' => $images_dir."x.jpg"
		, 'y' => $images_dir."y.jpg"
		, 'z' => $images_dir."z.jpg"
		);

	/*
	
	question: question to be displayed with images (parsed using markdown)
	question_label: the question number e.g. 2a, 3b
	correct: the js-compliant array index of the correct answer (1st answer = 0)
	answers: array of questions
		flagsrc [optional]: reference to flag to be displayed in the answer using $flagsrc[]
		description [optional]: text to be displayed in the answer

	*/
	array_push($questions, 
array(
  'name' => "On shore signals",
  'finishText' => 'Well done',
  'questions' => array(
	array('question' => "![AP](".$flagsrc['ap'].")

What is the name of this flag? "
	, 'question_label' => "1a"
	, 'correct' => 1
	, 'incorrectAnswerLabel' => "I dont think so - try again!"
	, 'answers' => array("Z - Zulu", "AP - Postponement", "C - Charlie")
	), 
	array('question' => "How many sounds when 

![AP](".$flagsrc['ap'].") 

is displayed?"
	, 'question_label' => "1b"
	, 'correct' => 1
	, 'answers' => array("TOOT", "TOOT TOOT", "TOOT TOOT TOOT", "No sound")
	), 
	array('question' => "The wind is outside safe parameters and the race committee wishes to abandon racing.

Which flag should they show?"
	, 'question_label' => "1c"
	, 'correct' => 1
	, 'answers' => array("![AP](".$flagsrc['ap'].")", "![N over A](".$flagsrc['n_a'].")", "![x](".$flagsrc['x'].")", "No flags - just up get in cars and drive away")
	)
  )
),

array(
  'name' => "Starting sequence", 
  'finishText' => 'Well done',
  'questions' => array(
	array('question' => "![AP](".$flagsrc['ap'].")

What is the name of this flag? "
	, 'question_label' => "2a"
	, 'correct' => 1
	, 'incorrectAnswerLabel' => "I dont think so - try again!"
	, 'answers' => array("Z - Zulu", "AP - Postponement", "C - Charlie")
	), 
	array('question' => "How many sounds when 

  ![AP](".$flagsrc['ap'].") 

is displayed?"
	, 'question_label' => "2b"
	, 'correct' => 1
	, 'answers' => array("TOOT", "TOOT TOOT", "TOOT TOOT TOOT", "No sound")
	), 
	array('question' => "Just after Preparatory was displayed the wind swung 40degrees . 

  Which flag should be displayed?"
	, 'question_label' => "2c"
	, 'correct' => 0
	, 'answers' => array("![AP](".$flagsrc['ap'].")", "![L](".$flagsrc['l'].")", "![X](".$flagsrc['x'].")", "No flags - just keep counting down")
	)
  )
),
array(
  'name' => "Altering course", 
  'finishText' => 'Well done',
  'questions' => array(
	array('question' => "![C](".$flagsrc['c'].")

What is the name of this flag? "
	, 'question_label' => "3a"
	, 'correct' => 2
	, 'incorrectAnswerLabel' => "I dont think so - try again!"
	, 'answers' => array("S - Shorten course", "X", "C - Charlie")
	), 
	array('question' => "How many sounds when 

![C](".$flagsrc['c'].") 

is displayed?"
	, 'question_label' => "3b"
	, 'correct' => 2
	, 'answers' => array("TOOT", "TOOT TOOT", "TOOT TOOT TOOT TOOT TOOT", "No sound")
	), 
	array('question' => "![S](".$flagsrc['s'].")

What is the name of this flag? "
	, 'question_label' => "3a"
	, 'correct' => 0
	, 'incorrectAnswerLabel' => "I dont think so - try again!"
	, 'answers' => array("S - Shorten course", "Y - Wear personal buoyancy", "C - Charlie")
	), 
	array('question' => "How many sounds when 

![S](".$flagsrc['s'].") 

is displayed?"
	, 'question_label' => "3b"
	, 'correct' => 1
	, 'answers' => array("TOOT", "TOOT TOOT", "TOOT TOOT TOOT TOOT TOOT", "No sound")
	),
  )
),
array(
  'name' => "Miscellaneous", 
  'finishText' => 'Well done',
  'questions' => array(
	array('question' => "![M](".$flagsrc['m'].")

What is the name of this flag? "
	, 'question_label' => "4a"
	,'correct' => 0
	, 'incorrectAnswerLabel' => "LOOK HERE MUMMY!"
	, 'answers' => array("M - Mike", "P - Papa", "D - Delta")
	), 
	array('question' => "How many sounds when 

![M](".$flagsrc['m'].") 

is displayed?"
	, 'question_label' => "4b"
	, 'correct' => 3
	, 'answers' => array("TOOT", "TOOT TOOT", "TOOT TOOT TOOT", "TOOT TOOT TOOT TOOT TOOT", "No sound")
	), 
	array('question' => "The race committee wants to move the start boat. 

Which flag will they display?"
	, 'question_label' => "4c"
	, 'correct' => 1
	, 'answers' => array("![AP](".$flagsrc['ap'].")", "![L](".$flagsrc['l'].")", "![BLUE](".$flagsrc['bl'].")","No flags - just up anchor and move")
	)
  )  	
)
);
echo json_encode($questions);

?>