<script>
    import {fade} from 'svelte/transition';

    export let size = '2.5em';
    export let ldColor = '#000';
    export let bgColor = '#fff';
    export let opacity = 0.7;
    export let duration = 800;
    export let classOverride = false;
    export let layer = true;
</script>

<section style="background-color: {bgColor}; opacity: {opacity}; z-index: 999" transition:fade={{duration: duration }}
         class="{classOverride} ajax_loader">
    {#if layer}
        <div class="loader" style="height:{size};width:{size}">
            <div class="ldr-blk an_delay one" style="background-color:{ldColor}"></div>
            <div class="ldr-blk an_delay two" style="background-color:{ldColor}"></div>
            <div class="ldr-blk an_delay three" style="background-color:{ldColor}"></div>
            <div class="ldr-blk an_delay four" style="background-color:{ldColor}"></div>
        </div>
    {/if}
</section>

<style>
    .loader {
        margin: auto;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }
    .ajax_loader {
        display: flex;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>