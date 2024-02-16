<script setup>
import { onMounted } from "vue";
import { useCommentsStore } from "../stores/comments";

const props = defineProps({
    id: Number,
});

const store = useCommentsStore();

onMounted(() => {
    store.fetchComments(props.id);
});
</script>

<template>
    <div>
        <div v-if="store.commentList.length > 0">
            <div
                v-for="(comment, index) in store.commentList"
                :key="index"
                class="comment"
            >
                <small>{{ comment.user.name }}</small>
                <p>{{ comment.content }}</p>
            </div>
        </div>
        <div v-else class="no-comments">コメントは投稿されていません。</div>
    </div>
</template>

<style scoped>
/* コメントリストコンテナの全体のスタイリング */
div {
    text-align: left; /* テキストを左揃えに設定 */
    padding: 1rem 0.5rem 0.5rem 0.5rem; /* 上に1rem、右と左に0.5rem、下に0.5remのパディングを設定 */
    background-color: #ffffff; /* 背景色を白に設定 */
}

/* 個々のコメントのスタイリング */
.comment {
    text-align: left; /* テキストを左揃えに設定 */
    padding: 0.2rem 1rem; /* 上下に0.2rem、左右に1remのパディングを設定 */
    margin-bottom: 0.5rem; /* 下部に0.5remのマージンを設定 */
    background-color: #f7f7f7; /* 背景色を薄いグレーに設定 */
    border-radius: 0.375rem; /* コンテナの角をわずかに丸める */
}

/* 個々のコメントのpタグのスタイリング */
.comment p {
    white-space: pre-wrap; /* テキスト内の空白と改行を保持 */
    word-wrap: break-word; /* 文字列を折り返す */
}

/* コメントがない場合のメッセージのスタイリング */
.no-comments {
    text-align: center; /* テキストを中央揃えに設定 */
    padding: 1rem; /* 全方向に1remのパディングを設定 */
    background-color: #ffffff; /* 背景色を白に設定 */
    margin: 1rem 0; /* 上下に1remのマージンを設定 */
}
</style>
