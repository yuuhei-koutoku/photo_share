<script setup>
import { ref } from "vue";
import { useCommentsStore } from "../stores/comments";

const props = defineProps({
    id: Number,
});

const commentContent = ref("");
const store = useCommentsStore();

const submitComment = async () => {
    if (commentContent.value.trim() === "") {
        alert("コメントが入力されていません。");
    } else if (commentContent.value.trim().length > 100) {
        alert("コメントは100文字以内で入力してください。");
    } else {
        await store.addComment(props.id, commentContent.value.trim());
        commentContent.value = "";
    }
};
</script>

<template>
    <div class="comment-area">
        <textarea
            v-model="commentContent"
            placeholder="コメントを入力してください"
        ></textarea>
        <button class="button-submit" @click="submitComment">送信</button>
    </div>
</template>

<style scoped>
/* コメントエリアのコンテナスタイリング */
.comment-area {
    display: flex; /* フレックスボックスを使用してアイテムを横並びにする */
    gap: 10px; /* アイテム間に10pxの隙間を設ける */
    align-items: center; /* アイテムを垂直方向の中央に揃える */
}

/* コメントテキストエリアのスタイリング */
textarea {
    flex-grow: 1; /* テキストエリアが利用可能なスペースを全て使用するようにする */
    padding: 10px; /* 内側に余白を設定 */
    border-radius: 5px; /* 角を丸める */
    border: 1px solid #ccc; /* 境界線のスタイル */
    resize: vertical; /* 垂直方向のリサイズのみ許可 */
}

/* 送信ボタンのスタイリング（提供されたスタイルを適用） */
.button-submit {
    background-color: #007bff; /* 青色の背景 */
    color: white; /* 文字は白色 */
    padding: 5px 10px; /* パディング */
    margin: 5px 0; /* マージン */
    border: none; /* 境界線なし */
    border-radius: 5px; /* 角丸のデザイン */
    cursor: pointer; /* カーソルをポインタに */
    font-size: 16px; /* フォントサイズ */
    transition: background-color 0.3s; /* 背景色の変化を滑らかに */
}

.button-submit:hover {
    background-color: #0056b3; /* マウスオーバー時の背景色 */
}
</style>
