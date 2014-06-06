angular.module('Flags', ['ngRoute','ngSanitize', 'hmTouchEvents'])
    // NOTE: The infdig error is caused by this and will be fixed in the next release of angular https://github.com/angular/angular.js/issues/3980
    .filter('markdown', function ($sce) {
        return function (input) {
            return $sce.trustAsHtml(marked(input));
        }
    })
    .service('GlobalService', function () {
        // Service to act as a model for the page title
        var pagetitle = "Flags";
        var page = "reference";    
        return {
            setTitle: function (title) {
                pagetitle = title;
            },
            getTitle: function() {
                return pagetitle;
            },
            updatePage: function(newpage) {
                page = newpage;
            },
            getPage: function() {
                return page;
            }
        }
    })
    .controller('NavCntl', function ($scope, GlobalService, $location, $route) {
        // Updates the page title when model changes
        $scope.$watch(GlobalService.getTitle, function (title) {
            $scope.title = title;
        })

        // Doesn't seem to be working ):
        // $locationProvider.html5mode(true).hashPrefix('!'); 

        $scope.mobile_menu = function () {
            $scope.nav_class = !$scope.nav_class
        }

        $scope.active_link = function (href) {
            if (href === GlobalService.getPage()) {
                return "active";
            } else {
                return "";
            }
        }
    })
    .controller('AllCntl', function ($scope, $timeout, GlobalService, $http, $sce) {
        
        // Controller for All Flags

        // Set page title
        // GlobalService.setTitle('Reference')
     
        $scope.cssTop = 100 
        
        // Pull JSON list of flags from /backend/all_flags.php
        $http.get('backend/all_flags.php', {cache: true}).success(function(data) {
            $scope.flags = data;
            angular.forEach($scope.flags, function (value, key) {
                $scope.flags[key].show = true;
            })
        });

        // Activated when a flag is clicked either on all flags or flag detail
        $scope.flipOver = function (flag) {
            $scope.index = $scope.flags.indexOf(flag); // finds flag in original array
            $scope.switchToFlag()
            $scope.cssTop = $(window).scrollTop()+00 // moves secondary display: RF changed to +00
        }

        $scope.switchToFlag = function () {
            if ($scope.index < 0) {
                $scope.index = 0
            }
            else if ($scope.index > $scope.flags.length-1) {
                $scope.index = $scope.flags.length-1
            }
            $scope.currentFlag = $scope.flags[$scope.index];
            $scope.currentDesc = $sce.trustAsHtml(marked($scope.flags[$scope.index].description))
            $scope.flippedState = true;
        }
        
        $scope.all = function () {
            $scope.flippedState = false;
        }

        $scope.prev = function () {
            $scope.index--
            $scope.switchToFlag()
        }

        $scope.next = function () {
            $scope.index++
            $scope.switchToFlag()
        }

        $scope.swipeleft = function () {
            $scope.$apply($scope.next)
        }

        $scope.swiperight = function () {
            
            $scope.$apply($scope.prev)
        }

        // Used in class="..." to show flag description in flag detail
        $scope.isActive = function (flag) {
            //var index = $scope.flags.indexOf(1flag);
            return (flag.active === true ? "active" : "");
        }

        window.swipe.left = $scope.swipeleft
        window.swipe.right = $scope.swiperight

    })
    .controller('QuestionListCntl', function($scope, $http, GlobalService, $sce, $location) {

        $scope.goTo = function (question) {
            var index = $scope.questions.indexOf(question);
            $location.path('/quiz/'+index)
        };

        $http.get('backend/questions.php').success(function(data) {
            $scope.questions = data;
        });
    })
    .controller('QuestionCntl', function($scope, $http, GlobalService, $sce, $timeout, $routeParams) {

        $scope.setIndex = $routeParams.index;

        $scope.answerdesc = function (answer) {
            return $sce.trustAsHtml(marked(answer));
        }

        $scope.next = function () {
            $scope.last_question = $scope.curr_question;
            $scope.curr_question = $scope.questions[$scope.setIndex].questions[$scope.qIndex];
            $scope.curr_question_name = $sce.trustAsHtml(marked($scope.curr_question.question))
            $scope.qIndex++;
            $scope.flip('front');

            $scope.transition = true;
            $timeout($scope.labelTransStop,  1100)
        };

        $scope.answerquestion = function (index) {
            if ($scope.curr_question.correct === index) {
                if( $scope.qIndex === $scope.questions[$scope.setIndex].questions.length ) {
                    $scope.answerIncorrect = false;
                    $scope.finalAnswerCorrect = true;

                    $scope.flip('back');

                } else {
                    $scope.next();
                }
            } else {
                $scope.answerIncorrect = true;
                $scope.finalAnswerCorrect = false;    

                $scope.flip("back");
            }
        };

        $scope.labelTransStop = function () {
            $scope.transition = false;
        }

        // Start asking questions
        $scope.run = function () {
            $scope.qIndex = 0;
            $scope.next();
            $scope.finishText = $scope.questions[$scope.setIndex].finishText;
        };

        $scope.flip = function (action) {
            if (action === "front") {
                $scope.flippedState = false;    
            } else if (action === "back") {
                $scope.flippedState = true;
            } else {
                $scope.flippedState = !$scope.flippedState;
            }  
        }
        
        // Retrieve question list from server
        $http.get('backend/questions.php').success(function(data) {
            $scope.questions = data;
            // $scope.format();
            $scope.run();
        });
    })
    .controller('ScenarioListCntl', function ($scope, $http, GlobalService, $sce, $location) {
        $scope.goTo = function (scenario) {
            var index = $scope.scenarios.indexOf(scenario);
            $location.path('/scenario/'+index)
        };

        $http.get('backend/scenario.php').success(function(data) {
            $scope.scenarios = data;
        });
    })
    .controller('ScenarioCntl', function($scope, $http, GlobalService, $timeout, $routeParams) {

        // Set up time display and variables
        $scope.reference = moment("11:00:00", "HH:mm:ss");
        $scope.time = $scope.reference.clone();
        $scope.currentScenario = $routeParams.index;
        $scope.currentSequence = {};
        $scope.currentSequenceId = 0;
        $scope.currentFlags = [];
        $scope.currentActions = [];
        $scope.flippedState = false;

        /*  
        ===================================================================
            Helper Functions
        =================================================================== */

            // Helper Function
            $scope.filterBackFaceFlags = function (value) {
                for (var i = 0; i < $scope.currentFlags.length; i++) {
                    if ($scope.currentFlags[i].name === value.name) {
                        // If already displayed
                        return false;
                    }
                }

                for (var i = 0; i < $scope.currentActions.length; i++) {
                    if ($scope.currentActions[i].flag === value) {
                        // If already displayed
                        return false;
                    }
                }
                
                // Otherwise display
                return true;
            };

            // Used by time to show display correctly (e.g. 0 -> 00)
            $scope.display = function (input) {
                if (input >= 10) {
                    return input;
                } else {
                    return "0"+input;
                }
            };

            // Just for fun, so far
            $scope.distraction = function () { //hehehehehe
                if ($scope.stopDistractions === false || typeof $scope.stopDistractions === "undefined") {
                    $scope.currentStatus = $scope.scenarios[$scope.currentScenario].distractions[Math.floor(Math.random()*$scope.scenarios[$scope.currentScenario].distractions.length)];
                }
                $timeout($scope.distraction, 5000);
            };
            $timeout($scope.distraction, 5000);

            $scope.muteDistraction = function () {
                $scope.stopDistractions = !$scope.stopDistractions;
                $scope.currentStatus = "Muted :("
            }

            $scope.updateSignal = function (val) {
                $scope.currSignal = val;
            }

            $scope.flip = function (action) {
                if (action === "front") {
                    $scope.flippedState = false;    
                } else if (action === "back") {
                    $scope.flippedState = true;
                } else {
                    $scope.flippedState = !$scope.flippedState;
                }  
            };


        /*  
        ===================================================================
            Associated with current actions
        =================================================================== */

            // Called when flag is clicked on back side, adds it to current actions
            $scope.displayFlag = function (flag) {
                // Add flag current Actions
                $scope.addAction('display', flag)

                // Turn card back over
                $scope.flip();
            };

            // Removes a flag from the "Current Flag" list
            $scope.removeFlag = function (flag) {
                // Add removal of flag to current actions
                $scope.addAction('remove', flag);
            };

            $scope.addAction = function (action, flag) {
                if (action === 'display') {
                    var _label = "Display "
                    var _action = flag.code+'|up'
                } else {
                    var _label = "Remove "
                    var _action = flag.code+'|down'
                }

                $scope.currentActions.push({
                    label: _label,
                    action: _action,
                    flag: flag
                })
            };

            $scope.removeAction = function (action) {
                var index = $scope.currentActions.indexOf(action);
                $scope.currentActions.splice(index, 1)
            };

            // Updates current flags from current actions
            $scope.pushActions = function () {

                for (var i=0; i<$scope.currentActions.length; i++) {
                    var _action = $scope.currentActions[i];
                    if (_action.action.split('|')[1] === "up") {
                        $scope.currentFlags.push(_action.flag);
                    } else if (_action.action.split('|')[1] === "down") {
                        var index = $scope.currentFlags.indexOf(_action.flag);
                        $scope.currentFlags.splice(index, 1)
                    }
                }

                $scope.currentFlags.sort();
            }

            $scope.checkActionsCorrect = function () {
                var _correctActions = $scope.currentSequence.correctActions;
                var _currentActions = $scope.currentActions;

                if (_correctActions.length !== _currentActions.length) return false;

                for (var i=0; i < _currentActions.length; i++) {
                    var _checkval = _correctActions.indexOf(_currentActions[i].action);
                    if (_checkval == -1) return false;
                }

                if ($scope.currSignal !== $scope.currentSequence.correctSignal) return false;

                return true;
            }

        
        /*  
        ===================================================================
            Handling countdowns + phase
        =================================================================== */

            // Called when countdown reaches next event
            $scope.doPhase = function () {
                if ($scope.checkActionsCorrect() === true) {
                    $scope.pushActions();
                    $scope.currentActions = [];
                    $scope.nextSequence();
                } else {
                    $scope.currentActions = [];
                    $scope.currentStatus = "Incorrect action: AP displayed and sequence restarted."
                    $scope.stopDistractions = true;
                    $scope.currentStatusHighlight = true;
                    $timeout(function () {$scope.stopDistractions = false; $scope.currentStatusHighlight = false;}, 4000)
                    // $scope.currentFlags = 
                    for (var i = 0, len = $scope.flags.length; i < len; i++) {

                        if ($scope.flags[i].code === 'ap')
                            $scope.currentFlags = [$scope.flags[i]]; // Return as soon as the object is found

                    }

                    var _divisor = Math.floor($scope.time.minute() / 10) * 10;
                    var _minutecheck = $scope.time.minute() % 10;

                    if( _minutecheck <= 2 ) {
                        $scope.reference = $scope.time.clone().minute(_divisor + 0);
                    } else if( _minutecheck <= 7 ) {
                        $scope.reference = $scope.time.clone().minute(_divisor + 5);
                    } else {
                        $scope.reference = $scope.time.clone().minute(_divisor + 10);
                    }
                    // $scope.reference = $scope.time.clone();

                    $scope.currentSequenceId = -1;
                    
                    $scope.nextSequence();
                }
            }

            $scope.nextSequence = function () {
                $scope.currentSequenceId++;
                if ($scope.currentSequenceId >= $scope.scenarios[$scope.currentScenario].sequences.length) {
                    $scope.status = "All clear, all clear";
                    $scope.stopDistractions = true;
                    $timeout(function () {$scope.stopDistractions = false;}, 4000)
                    return false;
                }
                $scope.currentSequence = $scope.scenarios[$scope.currentScenario].sequences[$scope.currentSequenceId];
                $scope.countdown();
            }

            // Handles the countdown to the next scenario
            $scope.countdown = function () {
                $scope.countdownScope = {
                    start: $scope.time.clone(),
                    end: 0,
                    duration: 10,
                    currentTick: 1
                }
                $scope.countdownScope.end = $scope.reference.clone().add('m', $scope.scenarios[$scope.currentScenario].sequences[$scope.currentSequenceId].time);

                $timeout($scope.tick, 1000);
            };

            // Called by countdown() to advance the clock every 1 second,
            // also controls what happens leading up to next even
            $scope.tick = function () {
                var diffAsMoment = moment.duration($scope.countdownScope.end.diff($scope.time))
                var diff = diffAsMoment.asMinutes()
                var diffS = diffAsMoment.asSeconds()
                
                // These if statements subtract the time they add on to find 
                // the time they would end up with if they were to 
                // execute their action (like a try/except loop)

                if (       diff - 5 >= 5) {     $scope.time.add(5, 'minutes');
                } else if (diff - 1 >= 1) {     $scope.time.add(1, 'minutes');
                } else if (diffS - 10 >= 20) {  $scope.time.add(10, 'seconds');
                } else if (diffS - 5 >= 10) {    $scope.time.add(5, 'seconds');
                } else if (diffS - 1 >= 0) {    
                    $scope.time.add(1, 'seconds'); 
                    $scope.currentStatus = "10 seconds to go...";
                    $scope.stopDistractions = true;
                }

                // Checks if the countdown is done
                if (diff <= 1 && diffS-1 === 0) {   
                    $scope.stopDistractions = false;
                    $scope.doPhase();
                } else {
                    // Continue if not finished
                    $timeout($scope.tick, 1000);
                }
            };




        $scope.run = function () {
            $scope.currentStatus = "Not much happening..."
            $scope.nextSequence();
        };

        // Retrieve question list from server
        $http.get('backend/scenario.php').success(function(data) {
            $scope.scenarios = data;
            $scope.run();
            // $timeout(function() {$('body').chardinJs('start')}, 2000);
        });

        $http.get('backend/all_flags.php', {cache: true}).success(function(data) {
            $scope.flags = data;
        });
        
    })
    .config(['$routeProvider', function($routeProvider, GlobalService) {

        // Sets up routes for project

        $routeProvider.
            when('/all', {templateUrl: 'tpl/all.html', controller: 'AllCntl', resolve: { update: function ($q, GlobalService) {GlobalService.updatePage('reference')}}})
            .when('/quiz', {templateUrl: 'tpl/questionlist.html',   controller: 'QuestionListCntl', resolve: { update: function ($q, GlobalService) {GlobalService.updatePage('question')}}})
            .when('/quiz/:index', {templateUrl: 'tpl/questions.html',   controller: 'QuestionCntl', resolve: { update: function ($q, GlobalService) {GlobalService.updatePage('question')}}})
            .when('/scenario', {templateUrl: 'tpl/scenariolist.html',   controller: 'ScenarioListCntl', resolve: { update: function ($q, GlobalService) {GlobalService.updatePage('scenario')}}})
            .when('/scenario/:index', {templateUrl: 'tpl/scenario.html',   controller: 'ScenarioCntl', resolve: { update: function ($q, GlobalService) {GlobalService.updatePage('scenario')}}})
            .otherwise({redirectTo: '/all'});
    }])

window.swipe = {}

$('body').hammer().on('swipeleft', function () {
    if (typeof window.swipe.left == "function") {
        window.swipe.left()
    }
})
$('body').hammer().on('swiperight', function () {
    if (typeof window.swipe.right == "function") {
        window.swipe.right()
    }
})