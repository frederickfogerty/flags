<?php 
	header('Content-Type: application/json');
	$flags = array();
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
	src: image source using $flagsrc[]
	name: shown as title in description
	description: text in description

	*/
	array_push($flags, array(
		'src' => $flagsrc['ap']
		, 'name' => 'AP'
		, 'code' => 'ap'
		, 'small_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, quaerat, vero, ad aperiam impedit velit cumque cupiditate iste minus enim maxime facilis qui nam consequuntur obcaecati aut recusandae dolor earum.'
		, 'description' => "Display: TOOT. Remove: TOOT TOOT (two toots).

AP Races not started are postponed. The warning signal will be made 1 minute after removal unless at that time the race is postponed again or abandoned."));
	array_push($flags, array(
		'src' => $flagsrc['p']
		, 'name' => 'Preparatory'
		, 'code' => 'p'
		, 'description' => "Display: TOOT . Remove: TOOOOOOOT (a long toot).

Raised 4 minutes before the starting signal.

Important definition of _Racing_: A boat is racing from her preparatory signal until she finishes and clears the finishing line and marks or retires, or until the race committee signals a general recall, postponement or abandonment."));
	array_push($flags, array(
		'src' => $flagsrc['i']
		, 'name' => 'I flag - Rule 30.1 is in effect'
		, 'code' => 'i'
		, 'description' => "Display: TOOT. Remove: TOOOOOOOT (a long toot).

If flag I has been displayed, and any part of a boat’s hull, crew or equipment is on the course side of the starting  line or one of its extensions during the last minute before her starting signal, she shall thereafter sail from the course side across an  extension to the pre-start side before starting."));
	array_push($flags, array(
		'src' => $flagsrc['z']
		, 'name' => 'Z flag - Rule 30.2 is in effect'
		, 'code' => 'z'
		, 'description' => "Display: TOOT. Remove: TOOOOOOOT (a long toot).

If flag Z has been displayed, no part of a boat’s hull, crew or equipment shall be in the triangle formed by the ends of the starting line and the first mark during the last minute before her starting signal. If a boat breaks this rule and is identified, she shall receive, without a hearing, a 20% Scoring Penalty calculated as stated in rule 44.3(c). She shall be penalized even if the race is restarted or resailed, but not if it is postponed or abandoned before the starting signal. If she is similarly identified during a subsequent attempt to start the same race, she shall receive an additional 20% Scoring Penalty."));
	array_push($flags, array(
		'src' => $flagsrc['bl']
		, 'name' => 'The Black Flag - Rule 30.3 is in effect'
		, 'code' => 'bl'
		, 'description' => "Display: TOOT. Remove: TOOOOOOOT (a long toot).

If a black flag has been displayed, no part of a boat’s hull, crew or equipment shall be in the triangle formed by the ends of the starting line and the first mark during the last minute before her starting signal. If a boat breaks this rule and is identified, she shall be disqualified without a hearing, even if the race is restarted or resailed, but not if it is postponed or abandoned before the starting signal. If a general recall is signalled or the race is abandoned after the starting signal, the race committee shall display her sail number before the next warning signal for that race, and if the race is restarted or resailed she shall not sail in it. If she does so, her disqualification shall not be excluded in calculating her series score."));
	array_push($flags, array(
		'src' => $flagsrc['x']
		, 'name' => 'X - Individual recall'
		, 'code' => 'x'
		, 'description' => "Display: TOOT. Remove: no sound.

When at a boat’s starting signal any part of her hull, crew or equipment is on the course side of the starting line or she must comply with rule 30.1, the race committee shall promptly display flag X with one sound. The flag shall be displayed until all such boats have sailed completely to the pre-start side of the starting line or one of its extensions and have complied with rule 30.1 if it applies, but no later than four minutes after the starting signal or one minute before any later starting signal, whichever is earlier. If rule 30.3 applies this rule does not."));
	array_push($flags, array(
		'src' => $flagsrc['fs']
		, 'name' => 'First substitute - General Recall'
		, 'code' => 'fs'
		, 'description' => "Display: TOOT TOOT (two toots) Remove: TOOT

When at the starting signal the race committee is unable to identify boats that are on the course side of the starting line or to which rule 30 applies, or there has been an error in the starting procedure, the race committee may signal a general recall (display the First Substitute with two sounds). 

The warning signal for a new start for the recalled class shall be made one minute after the First Substitute is removed (one sound), and the starts for any succeeding classes shall follow the new start."
		));
	array_push($flags, array(
		'src' => $flagsrc['s']
		, 'name' => 'S - Shortened Course'
		, 'code' => 's'
		, 'description' => "Display: TOOT TOOT (two toots) 

Rule 32. If the race committee signals a shortened course (displays flag S with two sounds), the finishing line shall be,

(a) at a rounding mark, between the mark and a staff displaying flag S;

(b) at a line boats are required to cross at the end of each lap, that line;

(c) at a gate, between the gate marks. 

The shortened course shall be signalled before the first boat crosses the finishing line."));
	array_push($flags, array(
		'src' => $flagsrc['c']
		, 'name' => 'C - Change the next leg'
		, 'code' => 'c'
		, 'description' => "Display: TOOT TOOT TOOT TOOT TOOT TOOT (repetitive toots)

Rule 33: The race committee may change a leg of the course that begins at a rounding mark or at a gate by changing the position of the next mark (or the finishing line) and signalling all boats before they begin the leg. The next mark need not be in position at that time.

(a) If the direction of the leg will be changed, the signal shall be
the display of flag C with repetitive sounds and either 

>(1) the new compass bearing or

>(2) a green triangle for a change to starboard or a red rectangle for a change to port.

(b) If the length of the leg will be changed, the signal shall be the display of flag C with repetitive sounds and a ‘–’ if the length will be decreased or a ‘+’ if it will be increased.

(c) Subsequent legs may be changed without further signalling to maintain the course shape."
));
	array_push($flags, array(
		'src' => $flagsrc['n']
		, 'name' => 'N - Abandon'
		, 'code' => 'n'
		, 'description' => "Display: TOOT TOOT TOOT (three toots) Remove: TOOT

After the starting signal, the race committee may shorten the course (display flag S with two sounds) or abandon the race (display flag N, N over H, or N over A, with three sounds), as appropriate,

(a) because of an error in the starting procedure,

(b) because of foul weather,

(c) because of insufficient wind making it unlikely that any boat
will finish within the time limit,

(d) because a mark is missing or out of position, or

(e) for any other reason directly affecting the safety or fairness of the competition, 

or may shorten the course so that other scheduled races can be sailed. However, after one boat has sailed the course and finished within the time limit, if any, the race committee shall not abandon the race without considering the consequences for all boats in the race or series."
));
	array_push($flags, array(
		'src' => $flagsrc['l']
		, 'name' => 'L'
		, 'code' => 'l'
		, 'description' => "Display: TOOT 

Made Ashore: A notice to competitors has been posted.

Made Afloat: Come within hail or follow this boat."
));
	array_push($flags, array(
		'src' => $flagsrc['m']
		, 'name' => 'M - Missing mark'
		, 'code' => 'm'
		, 'description' => "Display: TOOT TOOT TOOT TOOT TOOT TOOT (repetitive toots)

If a mark is missing or out of position, the race committee shall, if possible,

(a) replace it in its correct position or substitute a new one of
similar appearance, or

(b) substitute an object displaying flag M and make repetitive sound signals.
"
));
	array_push($flags, array(
		'src' => $flagsrc['y']
		, 'name' => 'Y - Wear a PFD'
		, 'code' => 'y'
		, 'description' => "Display: TOOT 

When flag Y is displayed with one sound before or with the warning signal, competitors shall wear personal flotation devices, except briefly while changing or adjusting clothing or personal equipment. Wet suits and dry suits are not personal flotation devices. "
		));
	array_push($flags, array(
		'src' => $flagsrc['b']
		, 'name' => 'Blue - finish boat on station'
		, 'code' => 'b'
		, 'description' => "Blue flag or shape. This race committee boat is in position at the finishing line. "
		));

	array_push($flags, array(
		'src' => $flagsrc['p1']
		, 'name' => 'Pennant 1'
		, 'code' => 'p1'
		, 'description' => "Display: TOOT TOOT Remove: TOOT

Pennant one."
		));
	array_push($flags, array(
		'src' => $flagsrc['p2']
		, 'name' => 'Pennant 2'
		, 'code' => 'p2'
		, 'description' => "Display: TOOT TOOT Remove: TOOT

Pennant two."
		));
	array_push($flags, array(
		'src' => $flagsrc['p3']
		, 'name' => 'Pennant 3'
		, 'code' => 'p3'
		, 'description' => "Display: TOOT TOOT Remove: TOOT

Pennant three."
		));
	array_push($flags, array(
		'src' => $flagsrc['p4']
		, 'name' => 'Pennant 4'
		, 'code' => 'p4'
		, 'description' => "Display: TOOT TOOT Remove: TOOT

Pennant four."
		));
	array_push($flags, array(
		'src' => $flagsrc['p5']
		, 'name' => 'Pennant 5'
		, 'code' => 'p5'
		, 'description' => "Display: TOOT TOOT Remove: TOOT

Pennant five."
		));
	array_push($flags, array(
		'src' => $flagsrc['p6']
		, 'name' => 'Pennant 6'
		, 'code' => 'p6'
		, 'description' => "Display: TOOT TOOT Remove: TOOT

Pennant six."
		));
	array_push($flags, array(
		'src' => $flagsrc['ap_h']
		, 'name' => 'AP over H'
		, 'code' => 'ap_h'
		, 'description' => "Display: TOOT TOOT

Races not started are _postponed_. Further signals ashore."
		));
	array_push($flags, array(
		'src' => $flagsrc['ap_a']
		, 'name' => 'AP over A'
		, 'code' => 'ap_a'
		, 'description' => "Display: TOOT TOOT

Races not started are _postponed_. No more racing today."
		));

	array_push($flags, array(
		'src' => $flagsrc['n_h']
		, 'name' => 'N over H'
		, 'code' => 'n_h'
		, 'description' => "Display: TOOT TOOT TOOT

All races are _abandoned_. Further signals ashore."
		));

	array_push($flags, array(
		'src' => $flagsrc['n_a']
		, 'name' => 'N over A'
		, 'code' => 'n_a'
		, 'description' => "Display: TOOT TOOT TOOT

All races are _abandoned_. No more racing today."
		));

	array_push($flags, array(
		'src' => $flagsrc['or']
		, 'name' => 'Orange'
		, 'code' => 'or'
		, 'description' => "Display: TOOT 

To alert boats that a race or sequence of races will begin soon, the orange starting line flag will be displayed with one sound 
at least five minutes before a warning signal is made."
		));

	array_push($flags, array(
		'src' => $flagsrc['las']
		, 'name' => 'Laser class'
		, 'code' => 'las'
		, 'description' => "Display: TOOT 

The warning signal for the Laser class, displayed 5 minutes before the start (* or as stated in the Sailing Instructions)"
		));

	echo json_encode($flags);

?>