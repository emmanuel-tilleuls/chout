<script>
    import { onMount } from "svelte";
    import { fetchPosts } from "./postApi.js";
    import PostItem from "./PostItem.svelte";

    let posts = null;
    let postListElement;

    onMount(() => {
        fetchPosts().then((resolvedPosts) => {
            posts = resolvedPosts;
        });

        const url = new URL('http://mercure.localhost/.well-known/mercure');
        url.searchParams.append('topic', 'http://localhost:8000/api/posts')
        const eventSource = new EventSource(url);

        eventSource.onmessage = (e) => {
            console.log(postListElement, e);
            const postData = JSON.parse(e.data);
            posts = [...posts, postData];
        };
    })
</script>

<ul bind:this={postListElement}>
    {#if posts == null}
        <p>Loading</p>
    {:else}
        {#each posts as post (post.id)}
            <li><PostItem {...post} /></li>
        {/each}
    {/if}
</ul>

<style>
    ul {
        padding-left: 0;
        width: 500px;

    }
    li {
        list-style: none;
        border: 1px solid black;
    }
</style>