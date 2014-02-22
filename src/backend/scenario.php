<?php
	header('Content-Type: application/json');
	$scenarios = array();
	$images_dir = "res/images/flags/";
	$flagsrc = array(
		'a' => $images_dir."a.png"
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
		, 'o' => $images_dir."o.jpg"
		, 'p' => $images_dir."p.jpg"
		, 'r' => $images_dir."r.jpg"
		, 's' => $images_dir."s.jpg"
		, 'u' => $images_dir."u.jpg"
		, 'x' => $images_dir."x.jpg"
		, 'y' => $images_dir."y.jpg"
		, 'z' => $images_dir."z.jpg"
		, 'ap' => $images_dir."ap.gif"
		, 'ap_a' => $images_dir."ap_a.gif"
		, 'ap_h' => $images_dir."ap_h.gif"
		, 'n_a' => $images_dir."n_a.png"
		, 'n_h' => $images_dir."n_h.png"
		, 'p1' => $images_dir."p1.png"
		, 'p2' => $images_dir."p2.png"
		, 'p3' => $images_dir."p3.png"
		, 'p4' => $images_dir."p4.png"
		, 'p5' => $images_dir."p5.png"
		, 'p6' => $images_dir."p6.png"
		);
	/*
	
	scenario_name: scenario_name
	sequences: array of breakpoints
		time: the time at which to stop the clock (in minutes from 0)
		option: markdown of options
		description "[optional]": text to be displayed in the answer
		correct: the correct flag for the breakpoint

	*/

	
	array_push($scenarios, array(
		'scenario_name' => "Start - all clear",
		'distractions' => array(
			"Looking good...",
            "Little Bobby has capsized, again...",
            "The seagulls crapped on the deck, again...",
            "Phil brought his smelly egg sandwiches again...",
            "The M class is late...",
            "Alex is too busy chatting up the girls..."
            )
		, 'sequences' => array(
			array(
				'time' => 4, 
				'correctActions' => array('ap|down'),
				'correctSignal' => '1short')
			, array(
				'time' => 5, 
				'correctActions' => array('las|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 6, 
				'correctActions' => array('p|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 9, 
				'correctActions' => array('p|down'),
				'correctSignal' => '1long')
			, array(
				'time' => 10, 
				'correctActions' => array('las|down'),
				'correctSignal' => '1short')
			)
		),
array(
		'scenario_name' => "Start - individual recall",
		'distractions' => array(
			"Looking good...",
            "The fleet is pretty keen...",
            "They are bunching at the pin end...",
            "Reckon we might have a few over here...",
            "Bit of barging, 235 is going to be over...",
            "Individual recall for 235 and 426..."
            )
		, 'sequences' => array(
			array(
				'time' => 4, 
				'correctActions' => array('ap|down'),
				'correctSignal' => '1short')
			, array(
				'time' => 5, 
				'correctActions' => array('las|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 6, 
				'correctActions' => array('p|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 9, 
				'correctActions' => array('p|down'),
				'correctSignal' => '1long')
			, array(
				'time' => 10, 
				'correctActions' => array('las|down'),
				'correctSignal' => '1short')
			)
		),
array(
		'scenario_name' => "Start - general recall",
		'distractions' => array(
			"Looking good...",
            "Little Bobby has capsized, again...",
            "The seagulls crapped on the deck, again...",
            "Phil brought his smelly egg sandwiches again...",
            "The M class is late...",
            "Alex is too busy chatting up the girls..."
            )
		, 'sequences' => array(
			array(
				'time' => 4, 
				'correctActions' => array('ap|down'),
				'correctSignal' => '2short')
			, array(
				'time' => 5, 
				'correctActions' => array('las|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 6, 
				'correctActions' => array('p|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 9, 
				'correctActions' => array('p|down'),
				'correctSignal' => '1long')
			, array(
				'time' => 10, 
				'correctActions' => array('las|down'),
				'correctSignal' => '1short')
			)
		),
array(
		'scenario_name' => "Start then abandon",
		'random_messages' => array(
			"Looking good...",
            "Little Bobby has capsized, again...",
            "The seagulls crapped on the deck, again...",
            "Phil brought his smelly egg sandwiches again...",
            "The M class is late...",
            "Alex is too busy chatting up the girls..."
            )
		, 'sequences' => array(
			array(
				'time' => 4, 
				'correctActions' => array('ap|down'),
				'correctSignal' => '2short')
			, array(
				'time' => 5, 
				'correctActions' => array('las|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 6, 
				'correctActions' => array('p|up'),
				'correctSignal' => '1short')
			, array(
				'time' => 9, 
				'correctActions' => array('p|down'),
				'correctSignal' => '1long')
			, array(
				'time' => 10, 
				'correctActions' => array('las|down'),
				'correctSignal' => '1short')
			)
		)

);
	echo json_encode($scenarios);








?>