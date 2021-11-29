<script>
    import TwoFrame from '/assets/builder/frame/Twoframe.svelte';
    import Description from '/assets/builder/component/Description.svelte';
    import List from '/assets/builder/component/List.svelte';
    import {Tabs, TabList, TabPanel, Tab} from '/assets/builder/component/tabs/tabs.js';

    export let data;
    let currentItem;
    let tabs;
    if (data) {
        tabs = [
            {label: 'Races', list: data.species},
            {label: 'Caractéristiques', list: data.characteristics},
            {label: 'Compétences', list: data.skills},
            {label: 'Classes', list: data.classes},
            {label: 'Carrières', list: data.careers},
            {label: 'Talents', list: data.talents},
            {label: 'Dieux', list: data.gods},
            {label: 'Sorts', list: data.spells},
            {label: 'Possessions', list: data.trappings},
            {label: 'Lieux', list: data.lore},
        ]
    }
</script>
<TwoFrame>
    <svelte:fragment slot="header">Compendium</svelte:fragment>
    <svelte:fragment slot="left">
        <Tabs>
            <TabList>
                {#each tabs as tab}
                    <Tab>{tab.label}</Tab>
                {/each}
            </TabList>

            {#each tabs as tab}
                <TabPanel>
                    <List {...tab} bind:selected={currentItem}/>
                </TabPanel>
            {/each}
        </Tabs>
    </svelte:fragment>
    <svelte:fragment slot="right">
        {#if currentItem}
            <Description {...currentItem}/>
        {/if}
    </svelte:fragment>
</TwoFrame>