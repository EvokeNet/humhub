var tl = new TimelineLite();

var $creativeVisionaryPowers = $("#creativeVisionaryPowers .power"),
    $creativeVisionary = $('#creativeVisionary'),
    $empatheticActivistPowers = $('#empatheticActivistPowers .power'),
    $empatheticActivist = $('#empatheticActivist'),
    $deepCollaboratorPowers = $('#deepCollaboratorPowers .power'),
    $deepCollaborator = $('#deepCollaborator'),
    $systemsThinkerPowers = $('#systemsThinkerPowers .power'),
    $systemsThinker = $('#systemsThinker'),
    powerOffsets = [],
    screenWidth = screen.width,
    title1 = document.getElementById('animationTitle').getAttribute('data-title-1'),
    title2 = document.getElementById('animationTitle').getAttribute('data-title-2');

// only need one set since they all "start" in the same position
$creativeVisionaryPowers.each(function(index, element){
  powerOffsets.push($(element).offset());
});

//start the timeline
//remove mask
tl.set('#animationMask', {opacity: 0});

tl.to('#animationTitle', 1, {text: title1, ease: Linear.easeNone});

// creative visionary powers
tl.staggerFrom($creativeVisionaryPowers, 4, {
  cycle: {
    x: [-screenWidth/2, screenWidth/2]
  },
  opacity: 0,
  ease:Power1.easeInOut
}, 0.5);
tl.to("#creativeVisionary", 3, {className: '+=draw'}, '-=2');
tl.set("#creativeVisionary .super-power-name", {className: '+=show'});
tl.staggerTo($creativeVisionaryPowers, 4, {
  cycle: {
    y: findPowerEndY(powerOffsets, $creativeVisionary.offset()),
    x: findPowerEndX(powerOffsets, $creativeVisionary.offset()),
    ease: Power1.easeInOut
  }
}, 0.1);
tl.to('#creativeVisionaryPowers .power-name', 1, {opacity: 0}, '-=4');

// empathetic activist powers
tl.staggerFrom($empatheticActivistPowers, 4, {
  cycle: {
    x: [-screenWidth/3, screenWidth/3]
  },
  opacity: 0,
  ease:Power1.easeInOut
}, 0.5, '-=1');
tl.to("#empatheticActivist", 3, {className: '+=draw'}, '-=2');
tl.set("#empatheticActivist .super-power-name", {className: '+=show'});
tl.staggerTo($empatheticActivistPowers, 4, {
  cycle: {
    y: findPowerEndY(powerOffsets, $empatheticActivist.offset()),
    x: findPowerEndX(powerOffsets, $empatheticActivist.offset()),
    ease: Power1.easeInOut
  }
}, 0.1);
tl.to('#empatheticActivistPowers .power-name', 1, {opacity: 0}, '-=4');

// deep collaborator powers
tl.staggerFrom($deepCollaboratorPowers, 4, {
  cycle: {
    x: [-screenWidth/3, screenWidth/3]
  },
  opacity: 0,
  ease:Power1.easeInOut
}, 0.5, '-=1');
tl.to("#deepCollaborator", 3, {className: '+=draw'}, '-=2');
tl.set("#deepCollaborator .super-power-name", {className: '+=show'});
tl.staggerTo($deepCollaboratorPowers, 4, {
  cycle: {
    y: findPowerEndY(powerOffsets, $deepCollaborator.offset()),
    x: findPowerEndX(powerOffsets, $deepCollaborator.offset()),
    ease: Power1.easeInOut
  }
}, 0.1);
tl.to('#deepCollaboratorPowers .power-name', 1, {opacity: 0}, '-=4');

// systems thinker powers
tl.staggerFrom($systemsThinkerPowers, 4, {
  cycle: {
    x: [-screenWidth/3, screenWidth/3]
  },
  opacity: 0,
  ease:Power1.easeInOut
}, 0.5, '-=1');
tl.to("#systemsThinker", 3, {className: '+=draw'}, '-=2');
tl.set("#systemsThinker .super-power-name", {className: '+=show'});
tl.staggerTo($systemsThinkerPowers, 4, {
  cycle: {
    y: findPowerEndY(powerOffsets, $systemsThinker.offset()),
    x: findPowerEndX(powerOffsets, $systemsThinker.offset()),
    ease: Power1.easeInOut
  }
}, 0.1);
tl.to('#systemsThinkerPowers .power-name', 1, {opacity: 0}, '-=4');

tl.to('#animationTitle', 1, {text: title2, ease: Linear.easeNone });

tl.to('#loginForms', 1, {y: '-200px', ease:Power3.easeInOut});
tl.to('#loadedBody', 1, {y: '-200px', ease:Power3.easeInOut}, '-=1');

// helper functions
function findPowerEndY(powerOffsets, targetOffset){
  var yCoords = [];
  //find starting point
  yCoords.push(targetOffset.top - powerOffsets[0].top + 50);

  //place the rest
  yCoords.push(yCoords[0]);
  yCoords.push(yCoords[0]);
  yCoords.push(yCoords[0]);


  // for (var i = 0; i < powerOffsets.length; i++) {
  //   yCoords.push(targetOffset.top - powerOffsets[i].top);
  // }
  return yCoords;
}

function findPowerEndX(powerOffsets, targetOffset){
  var xCoords = [];

  xCoords.push(targetOffset.left - powerOffsets[0].left - 50);

  //place the rest
  xCoords.push(xCoords[0] + 100);
  xCoords.push(xCoords[0]);
  xCoords.push(xCoords[0] + 100);

  // for (var i = 0; i < powerOffsets.length; i++) {
  //   xCoords.push(targetOffset.left - powerOffsets[i].left);
  // }

  return xCoords;
}
