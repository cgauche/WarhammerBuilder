<script>
    export let list;
    export let selected;

</script>
<ol class="selectable">
    {#each list as el}
        <li class="ui-widget-content"
            class:ui-selected={selected && selected.id === el.id}
            on:click={() => selected = el}
        >{el.label}</li>
    {/each}
</ol>
<style>
    .ui-widget-content {
        background: rgb(38, 38, 38);
        color: white;
        border: 1px solid #F39814;
    }

    .selectable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .selectable li {
        margin: 3px;
        padding: 0.4em;
        height: 18px;
    }

    .selectable li {
        border: 1px solid #F39814;
    }

    .selectable .ui-selected {
        background: #F39814;
        color: rgb(38, 38, 38);
        font-weight: bold;
    }
</style>