<script>
    export let id;
    export let author;
    export let message;
    export let createdAt;
</script>

<div class="post">
    <span class="post_message">{message}</span>
    <span class="post_author">{author}</span>
    <span class="post_created-at">{createdAt.toLocaleString()}</span>
</div>

<style>
    .post {
        padding: 0.4rem;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    .post_message {
        text-align: left;
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .post_author {
        font-style: italic;
        font-size: 0.9rem;
    }


    .post_created-at {
        margin-left: auto;
        font-size: small;
        margin-right: 0.5rem;
    }
</style>