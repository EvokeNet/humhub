var tl = new TimelineLite();

var $creativeVisionaryPowers = $("#creativeVisionaryPowers .power"),
    $creativeVisionary = $('#creativeVisionary'),
    $empatheticActivistPowers = $('#empatheticActivistPowers .power'),
    $empatheticActivist = $('#empatheticActivist'),
    powerOffsets = [];

// only need one set since they all "start" in the same position
$creativeVisionaryPowers.each(function(index, element){
  powerOffsets.push($(element).offset());
});


//start the timeline
// creative visionary powers
tl.staggerFrom($creativeVisionaryPowers, 5, {
  cycle: {
    x: [-1000, 1000]
  },
  opacity: 0,
  ease:Power4.easeInOut
}, 1);
tl.to("#creativeVisionary", 2, {className: '+=draw'}, '-=2');
tl.set("#creativeVisionary .super-power-name", {className: '+=show'});
tl.staggerTo($creativeVisionaryPowers, 4, {
  cycle: {
    y: findPowerEndY(powerOffsets, $creativeVisionary.offset()),
    x: findPowerEndX(powerOffsets, $creativeVisionary.offset())
  }
}, 0.5);

// empathetic activist powers
tl.staggerFrom($empatheticActivistPowers, 5, {
  cycle: {
    x: [-1000, 1000]
  },
  opacity: 0,
  ease:Power4.easeInOut
}, 1);
tl.to("#empatheticActivist", 2, {className: '+=draw'}, '-=2');
tl.set("#empatheticActivist .super-power-name", {className: '+=show'});
tl.staggerTo($empatheticActivistPowers, 4, {
  cycle: {
    y: findPowerEndY(powerOffsets, $empatheticActivist.offset()),
    x: findPowerEndX(powerOffsets, $empatheticActivist.offset())
  }
}, 0.5);






// helper functions
function findPowerEndY(powerOffsets, targetOffset){
  var yCoords = [];
  //find starting point
  yCoords.push(targetOffset.top - powerOffsets[0].top + 50);

  //place the rest
  yCoords.push(yCoords[0]);
  yCoords.push(yCoords[0] + 50);
  yCoords.push(yCoords[0] +50);


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
