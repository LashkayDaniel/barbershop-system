<template>
    <div class="loader"></div>
</template>

<script setup>
</script>
<style scoped>
.loader {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: radial-gradient(farthest-side, #468ca9 94%, #0000) top/4px 4px no-repeat,
    conic-gradient(#0000 30%, #3ba1c0);
    -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 4px), #000 0);
    animation: s3 1s infinite linear;
}

@keyframes s3 {
    100% {
        transform: rotate(1turn)
    }
}
</style>
