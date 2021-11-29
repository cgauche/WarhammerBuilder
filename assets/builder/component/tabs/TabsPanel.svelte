<script>
    import { getContext } from 'svelte';
    import { TABS } from '/assets/builder/component/tabs/Tabs.svelte';

    const panel = {};
    const { registerPanel, selectedPanel } = getContext(TABS);

    registerPanel(panel);
</script>

{#if $selectedPanel === panel}
    <slot></slot>
{/if}