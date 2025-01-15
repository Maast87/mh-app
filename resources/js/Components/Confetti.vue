<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const canvas = ref(null);
let ctx = null;
let confetti = [];
let animationFrameId = null;

const colors = ['#2EA186', '#0F92DB', '#D3455B'];
const gravity = 0.2;
const terminalVelocity = 5;
const drag = 0.075;
const numberOfPieces = 300;

class Particle {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.rotation = random(0, 2 * Math.PI);
        this.color = colors[Math.floor(random(0, colors.length))];
        this.size = random(8, 12);
        this.thickness = random(2, 4);
        
        // Initial velocity - shoot upwards
        this.velocity = {
            x: random(-3, 3),
            y: random(-25, -5)
        };
    }

    update() {
        // Apply gravity
        this.velocity.y += gravity;
        
        // Apply drag
        this.velocity.y = Math.min(this.velocity.y, terminalVelocity);
        this.x += this.velocity.x;
        this.y += this.velocity.y;
        
        // Rotate the piece
        this.rotation += 0.1;
    }

    draw(ctx) {
        ctx.save();
        ctx.translate(this.x, this.y);
        ctx.rotate(this.rotation);
        
        ctx.fillStyle = this.color;
        ctx.fillRect(
            -this.size / 2,
            -this.thickness / 2,
            this.size,
            this.thickness
        );
        
        ctx.restore();
    }
}

function random(min, max) {
    return Math.random() * (max - min) + min;
}

function createConfetti() {
    confetti = [];
    const canvasWidth = canvas.value.width;
    const canvasHeight = canvas.value.height;
    
    for (let i = 0; i < numberOfPieces; i++) {
        // Start from bottom of screen
        confetti.push(new Particle(
            random(0, canvasWidth),
            canvasHeight + random(0, 50)
        ));
    }
}

function resizeCanvas() {
    if (canvas.value) {
        canvas.value.width = window.innerWidth;
        canvas.value.height = window.innerHeight;
    }
}

function animate() {
    ctx.clearRect(0, 0, canvas.value.width, canvas.value.height);
    
    confetti.forEach((particle, index) => {
        particle.update();
        particle.draw(ctx);
        
        // Remove particles that are off screen
        if (particle.y > canvas.value.height + 50) {
            confetti.splice(index, 1);
        }
    });
    
    // Stop animation when all confetti is gone
    if (confetti.length > 0) {
        animationFrameId = requestAnimationFrame(animate);
    }
}

function startAnimation() {
    if (canvas.value) {
        createConfetti();
        animate();
    }
}

onMounted(() => {
    if (canvas.value) {
        ctx = canvas.value.getContext('2d');
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
        startAnimation();
    }
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', resizeCanvas);
    if (animationFrameId) {
        cancelAnimationFrame(animationFrameId);
    }
});

defineExpose({
    startAnimation
});
</script>

<template>
    <canvas ref="canvas" class="confetti fixed inset-0 pointer-events-none z-[9999]"></canvas>
</template>

<style scoped>
.confetti {
    pointer-events: none;
}
</style> 