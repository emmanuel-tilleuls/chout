<script>
    import {author} from "./store.js";

    let name = '';
</script>

{#if $author === ''}
    <label>
        Author :
        <input bind:value={name} type="text" placeholder="Please, identify yourself">
        <button on:click={() => {author.set(name)}} disabled={(name === '') || null}>Log in</button>
    </label>
{:else}
    <span>Connected as <i>{$author}</i></span>
    <button on:click={() => {author.set('')}}>Log out</button>
{/if}
