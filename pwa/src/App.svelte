<script>
  import PostList from "./PostList.svelte";
  import CreatePost from "./CreatePost.svelte";
  import Credential from "./Credential.svelte";
</script>

<nav>
  <div class="credential">
    <Credential />
  </div>
</nav>
<main>
  <h1>Chout</h1>

  <PostList />
  <CreatePost />

</main>

<style>
  .credential {
    width: fit-content;
    margin-left: auto;
  }
</style>
