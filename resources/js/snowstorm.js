snow = {
  count: 60,
  delay: 10,
  flutter: 0.2,
  wind: 1.0,
  w1: 1,
  minSpeed: 0.3,
  maxSpeed: 4,
  cv: null,
  flakes: [],
  toggle: function() {
    if(window.snowtimer)
      snow.stop();
    else
      snow.start();
  },
  resize: function() {
    snow.cv.width = innerWidth;
    snow.cv.height = innerHeight;
    snow.gt = snow.ct.createLinearGradient(0,0,0,snow.cv.height);
    snow.gt.addColorStop(0.0, '#6666ff');
    snow.gt.addColorStop(1.0, '#ffffff');
    snow.ct.fillStyle = snow.gt;
  },
  start: function() {
    snow.cv = document.createElement('canvas');
    snow.cv.width = snow.cv.height = 10; // set initial size
    snow.cv.id = 'backgroundSnowCanvas';
    document.body.appendChild(snow.cv);
    snow.createFlake();
    snow.ct = snow.cv.getContext('2d'),
    snow.cv.style.position = 'absolute';
    snow.cv.style.top = 0;
    snow.cv.style.left = 0;
    snow.cv.style.zIndex = -1;
    snow.resize();
    var c = snow.count;
    snow.flakes = [];
    do {
      snow.flakes.push(new snow.flake());
    } while(--c);
    //snow.ct.fillRect(0,0,snow.cv.width,snow.cv.height);
    window.snowtimer = window.setInterval(snow.draw, snow.delay);
    window.addEventListener('resize',snow.resize);
  },
  stop: function() {
    window.clearInterval(window.snowtimer);
    var c = document.getElementById('backgroundSnowCanvas');
    c.parentNode.removeChild(c);
    window.snowtimer=snow=null;
  },
  draw: function() {
    var ct = snow.ct, f = snow.flakes, c = snow.count;
    var lineargradient = ct.createLinearGradient(0,0,0,250);
    lineargradient.addColorStop(0,'red');
    lineargradient.addColorStop(0.32,'blue');
    lineargradient.addColorStop(0.48,'green');
    lineargradient.addColorStop(0.64,'yellow');
    lineargradient.addColorStop(0.80,'orange');
    lineargradient.addColorStop(0.96,'red');
    lineargradient.addColorStop(1,'hotpink');
    ct.fillStyle = lineargradient;
    ct.fillRect(0,0,snow.cv.width,snow.cv.height);

    do {
      if(f[--c].draw(ct) && ++fdone) { };
    } while(c);
    snow.wind += Math.cos(snow.w1++ / 180.0);
  },
  flake: function() {
    this.draw = function(ct) {
      ct.drawImage(snow.flakeImage,this.x + snow.wind,this.y,this.sz,this.sz);
      this.animate();
    };
    this.animate = function() {
      this.y += this.speed;
      this.x += this.flutter * Math.cos(snow.flutter * snow.flutter * this.y);
      if(this.y > innerHeight)
        this.init(1);
    };
    this.init = function(f) {
      this.speed = snow.minSpeed + (Math.random() * (snow.maxSpeed - snow.minSpeed));
      this.sz = ~~(Math.random() * 40) + 20;
      this.flutter = ~~(Math.random() * snow.flutter * (60-this.sz));
      this.x = (Math.random() * (innerWidth + this.sz)) - this.sz;
      this.y = f ? -this.sz : Math.random() * innerHeight;
    };
    this.init();
  },
  createFlake: function() {
    snow.flakeImage = document.createElement('canvas');
    snow.flakeImage.width = snow.flakeImage.height = 40;
    var c = snow.flakeImage.getContext('2d');
    c.fillStyle = '#fff';
    c.translate(20,20);
    c.beginPath();
    c.rect(-5,-20,10,40);
    c.rotate(Math.PI / 3.0);
    c.rect(-5,-20,10,40);
    c.rotate(Math.PI / 3.0);
    c.rect(-5,-20,10,40);
    c.closePath();
    c.fill();
  },
};

window.onload = function() {
  try {
    snow.count = 30;   // number of flakes
    snow.delay = 20;   // timer interval
    snow.minSpeed = 2; // minimum movement/time slice
    snow.maxSpeed = 5; // maximum movement/time slice
    snow.start();
  } catch(e) {
    // no snow :(
  }
};