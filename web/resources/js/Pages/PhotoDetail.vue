<script setup>
import { ref, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import CommentList from "../Components/CommentList.vue";
import CommentForm from "../Components/CommentForm.vue";

const props = defineProps({
    id: String,
});

const photo = ref(null);

onMounted(() => {
    axios
        .get(`/api/photos/${props.id}`)
        .then((response) => {
            photo.value = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
});
</script>

<template>
    <div>
        <Head title="Photo Detail" />

        <div class="content">
            <div class="header-links">
                <Link :href="'/'" class="link">Photo Share</Link>

                <template v-if="$page.props.auth.user">
                    <Link :href="route('dashboard')" class="link"
                        >Dashboard</Link
                    >
                </template>

                <template v-else>
                    <Link :href="route('login')" class="link">Log in</Link>
                    <Link :href="route('register')" class="link">Register</Link>
                </template>
            </div>

            <div class="photo-detail">
                <div v-if="photo" class="photo-content">
                    <div class="photo-text">
                        <h2 class="photo-title">Photo Detail</h2>
                        <p>ID: {{ photo.id }}</p>
                        <p>投稿者: {{ photo.user.name }}</p>
                    </div>
                    <div class="photo-image-container">
                        <img
                            :src="`/storage/photos/${photo.file_name}`"
                            alt=""
                            class="photo-image"
                        />
                    </div>
                </div>
            </div>
            <div v-if="photo" class="comment-list">
                <CommentList :id="photo.id" />
            </div>
            <div v-if="$page.props.auth.user && photo" class="comment-form">
                <CommentForm :id="photo.id" />
            </div>
        </div>
    </div>
</template>

<style scoped>
/* ヘッダー内のリンクエリアのスタイリング */
.header-links {
    display: flex; /* フレックスボックスレイアウトを使用してアイテムを横並びに配置 */
    justify-content: flex-end; /* アイテムをコンテナの右端に寄せる */
    align-items: center; /* アイテムを垂直方向の中心に揃える */
    padding: 1.5rem; /* コンテナの内側に上下左右1.5remの余白を設定 */
}

/* ナビゲーションリンクのスタイリング */
.link {
    margin-left: 1rem; /* 左側に1remの余白を設ける */
    font-weight: 600; /* テキストの太さを600に設定 */
    color: #4b5563; /* テキストの色を設定 */
    text-decoration: none; /* テキストの下線を除去 */
}

/* ナビゲーションリンクのホバースタイル */
.link:hover {
    color: #1f2937; /* ホバー時にテキストの色を変更 */
}

/* ナビゲーションリンクのアクティブスタイル */
.link:active {
    outline: 2px solid #ef4444; /* アクティブ時に赤いアウトラインを設定 */
    outline-offset: 2px; /* アウトラインの外側に2pxのオフセットを設定 */
    border-radius: 0.125rem; /* アウトラインの角をわずかに丸める */
}

/* コンテンツエリアのスタイリング */
.content {
    display: flex; /* フレックスボックスレイアウトを使用 */
    flex-direction: column; /* アイテムを縦方向に並べる */
    justify-content: flex-start; /* アイテムをコンテナの上端に寄せる */
    min-height: 100vh; /* コンテナの最小の高さをビューポートの高さと同じに設定 */
    background-color: #f3f4f6; /* 背景色を設定 */
}

/* 写真詳細エリアのスタイリング */
.photo-detail {
    display: flex; /* フレックスボックスレイアウトを使用 */
    justify-content: center; /* アイテムを水平方向の中央に配置 */
    align-items: center; /* アイテムを垂直方向の中央に配置 */
    width: 100%; /* コンテナの幅を100%に設定 */
    max-width: 540px; /* コンテナの最大幅を540pxに制限 */
    margin: 0 auto; /* 上下のマージンを0、左右のマージンを自動で調整して中央寄せ */
    padding: 12px 24px; /* 上下に12px、左右に24pxのパディングを設定 */
}

/* 写真とテキストを含むコンテンツのスタイリング */
.photo-content {
    display: flex; /* フレックスボックスレイアウトを使用してアイテムを横並びに配置 */
    width: 100%; /* コンテナの幅を100%に設定 */
}

/* 写真に関するテキスト情報のエリアのスタイリング */
.photo-text {
    flex: 1; /* 利用可能なスペースを均等に分配 */
}

/* 写真画像を含むコンテナのスタイリング */
.photo-image-container {
    flex: 1; /* 利用可能なスペースを均等に分配 */
    display: flex; /* フレックスボックスレイアウトを使用して中央寄せ */
    justify-content: center; /* アイテムを水平方向の中央に配置 */
}

/* 写真画像自体のスタイリング */
.photo-image {
    max-width: 100%; /* 画像の最大幅をコンテナの幅に合わせる */
    height: auto; /* 高さを自動調整してアスペクト比を維持 */
    border-radius: 0.375rem; /* 画像の角をわずかに丸める */
}

/* 写真詳細タイトルのスタイリング */
.photo-title {
    font-size: 1.5rem; /* タイトルのフォントサイズを1.5remに設定 */
    font-weight: bold; /* タイトルのフォントの太さを太く設定 */
    margin-bottom: 0.5rem; /* タイトル下のマージンを0.5remに設定 */
}

/* コメントリストの全体のスタイリング */
.comment-list {
    display: flex; /* フレックスボックスレイアウトを使用してアイテムを縦方向に並べる */
    flex-direction: column; /* アイテムを縦方向に配置 */
    justify-content: flex-start; /* アイテムをコンテナの上端に寄せる */
    width: calc(
        100% - 48px
    ); /* コンテナの幅を親要素の幅から48px引いた値に設定 */
    max-width: calc(540px - 48px); /* コンテナの最大幅を492pxに制限 */
    margin: 1rem auto; /* 上下に1rem、左右のマージンを自動で調整して中央寄せ */
    border-radius: 0.375rem; /* コンテナの角をわずかに丸める */
    background-color: #ffffff; /* 背景色を白に設定 */
}

/* コメントフォームのスタイリング */
.comment-form {
    width: calc(
        100% - 48px
    ); /* コンテナの幅を親要素の幅から48px引いた値に設定 */
    max-width: calc(540px - 48px); /* コンテナの最大幅を492pxに制限 */
    margin: 0 auto 1rem; /* 下方向のマージンを1rem、左右のマージンを中央寄せに設定 */
    padding: 1rem; /* 上下方向に0.5remのパディングを設定 */
    background-color: #ffffff; /* 背景色を白に設定 */
}
</style>
