const canvas = document.getElementById('roulette');
const ctx = canvas.getContext('2d');
const rouletteImg = new Image();
rouletteImg.src = '../assets/ruleta2.png';

let ballAngle = -Math.PI / 2; // zacetna pozicija = -180stopinj (na vrhu)
let ballSpeed = 0;
let spinning = false;

const segments = 37;
const segmentAngle = (2 * Math.PI) / segments;
const numberSequence = [25, 17, 34, 6, 27, 13, 36, 11, 30, 8, 23, 10, 5, 24, 16, 33, 1, 20, 14, 31, 9, 22, 18, 29, 7, 28, 12, 35, 3, 26, 0, 32, 15, 19, 4, 21, 2];

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw static wheel
    ctx.drawImage(rouletteImg, 0, 0, canvas.width, canvas.height);

    // Ball position (inner circle)
    ctx.save();
    ctx.translate(canvas.width / 2, canvas.height / 2);
    const radius = 145; // adjust based on your wheel image
    const ballX = radius * Math.cos(ballAngle);
    const ballY = radius * Math.sin(ballAngle);

    ctx.beginPath();
    ctx.arc(ballX, ballY, 8, 0, 2 * Math.PI);
    ctx.fillStyle = 'white';
    ctx.fill();
    ctx.stroke();
    ctx.restore();
}

function randomNumber(){
    return numberSequence[Math.floor(Math.random() * numberSequence.length)];
}

function spinBall(chosenNumber) {
    if (spinning) return;
    spinning = true;

    console.log("Chosen number:", chosenNumber);
    const indexOnWheel = numberSequence.indexOf(chosenNumber);

    const angleOffset = -Math.PI / 2;
    const targetSegmentAngle = angleOffset + indexOnWheel * segmentAngle;

    const extraSpins = 5;
    const startAngle = ballAngle;
    const targetAngle = startAngle + extraSpins * 2 * Math.PI + (targetSegmentAngle - (startAngle % (2 * Math.PI)));

    const duration = 3000;
    const startTime = performance.now();

    function animate(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easedProgress = 1 - Math.pow(1 - progress, 3);

        ballAngle = startAngle + (targetAngle - startAngle) * easedProgress;

        draw();

        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            spinning = false;
            ballAngle = targetSegmentAngle;
            draw();
            console.log("Ball visually landed on:", chosenNumber);
            endResult(chosenNumber);
        }
    }

    requestAnimationFrame(animate);
}


rouletteImg.onload = () => {
    draw();
};