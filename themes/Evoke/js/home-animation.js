var tl = new TimelineLite();

var creativeVisionaryPowers = $("#creativeVisionaryPowers .power");

tl.staggerFrom(creativeVisionaryPowers, 5, {
  cycle: {
    x: [-1000, 1000]
  },
  opacity: 0,
  ease:Power4.easeInOut
}, 1);
tl.to("#creativeVisionary", 2, {className: '+=draw'}, '-=2');
tl.set("#creativeVisionary .super-power-name", {className: '+=show'});
