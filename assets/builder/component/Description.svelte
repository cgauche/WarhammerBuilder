<script>
    export let label;
    export let desc;
</script>

<div class='description'>
    <h3>{label}</h3>
    <span>{@html desc}</span>
</div>

<style>
    .description {
        padding: 10px;
    }
    h3 {
        text-align: center;
    }
</style>