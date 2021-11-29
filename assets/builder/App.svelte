<script>
    import {onMount} from 'svelte';
    import Loader from '/assets/builder/frame/Loader.svelte';
    import Compendium from '/assets/builder/step/Compendium.svelte';

    let data;
    let currentStep;

    async function loadData() {
        data = await fetch(`https://script.google.com/macros/s/AKfycbwjQfp1n_cQCohkYG1oyDkUvIWWt1SXWfDGnsL_yWK7BS4FJUYAxoXD9ED9gu9z8_Axtg/exec?json=1`).then(r => r.json());
        currentStep = Compendium;
    }

    onMount(loadData);
</script>
<main>
    {#if currentStep}
        <svelte:component this={currentStep} data={data}/>
    {:else}
        <Loader/>
    {/if}
</main>
<style>
    main {
        margin: 0;
        width: 100%;
        color: white;
        background: rgb(38, 38, 38);
        font-family: Verdana,Arial,sans-serif;
        font-size: 1em;
    }
</style>