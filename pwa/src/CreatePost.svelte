<script>
    import {createPost} from "./postApi.js";

    let message;

    function postMessage() {
        createPost({message});

        message = "";
    }
</script>

<div class="create-post_container">
    <input type="text" bind:value={message} placeholder="Gimme your personal thoughts 😈">
    <button on:click={postMessage}>Post</button>
</div>

<style>
    .create-post_container {
        width: 100%;
        display: flex;
    }
    input {
        flex-grow: 1;
        line-height: 1.8rem;
        margin-right: 10px;
    }
</style>