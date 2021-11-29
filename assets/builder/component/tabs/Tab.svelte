<script>
    import { getContext } from 'svelte';
    import { TABS } from '/assets/builder/component/tabs/Tabs.svelte';

    const tab = {};
    const { registerTab, selectTab, selectedTab } = getContext(TABS);

    registerTab(tab);
</script>

<style>
    button {
        border: 1px solid #F39814;
        border-bottom-width: 0;
        background: rgb(38, 38, 38);
        color: white;
        margin: 0;
        line-height: 1.3;
        font-size: 100%;
    }

    .selected {
        background: rgb(86, 86, 86);
        margin-bottom: -1px;
        padding-bottom: 1px;
    }
</style>

<button class:selected="{$selectedTab === tab}" on:click="{() => selectTab(tab)}">
    <slot></slot>
</button>