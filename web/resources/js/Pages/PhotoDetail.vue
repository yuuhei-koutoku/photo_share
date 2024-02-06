<script setup>
import { ref, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";

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
        </div>
    </div>
</template>

<style scoped>
/* ヘッダーエリアのスタイリング */
.header-links {
    display: flex; /* フレックスボックスを使用 */
    justify-content: flex-end; /* アイテムを右側に寄せる */
    align-items: center; /* アイテムを垂直方向に中央揃え */
    padding: 1.5rem; /* 上下左右のパディング */
}

/* リンクのスタイリング */
.link {
    margin-left: 1rem; /* 左のマージン */
    font-weight: 600; /* フォントの太さ */
    color: #4b5563; /* 文字色 */
    text-decoration: none; /* 下線をなしに */
}

.link:hover {
    color: #1f2937; /* ホバー時の文字色 */
}

.link:active {
    outline: 2px solid #ef4444; /* 長押し時の赤い枠線 */
    outline-offset: 2px; /* アウトラインのオフセット */
    border-radius: 0.125rem; /* ボーダーの丸み */
}

/* コンテンツエリアのスタイリング */
.content {
    display: flex; /* フレックスボックスモデルを使用してアイテムを配置 */
    flex-direction: column; /* アイテムを縦方向に配置 */
    justify-content: flex-start; /* アイテムをコンテナの上端に揃える */
    min-height: 100vh; /* コンテナの最小高さをビューポートの高さの100%に設定 */
    background-color: #f3f4f6; /* 背景色を設定 */
    background-position: center; /* 背景画像をコンテナの中央に配置 */
    background-repeat: no-repeat; /* 背景画像を繰り返さないように設定 */
}

/* フォトディテールエリアのスタイリングを調整 */
.photo-detail {
    display: flex; /* フレックスボックスモデルを使用してアイテムを配置 */
    justify-content: center; /* アイテムをコンテナの中央に揃える */
    align-items: center; /* アイテムを垂直方向の中央に揃える */
    width: 100%; /* コンテナの幅を親要素の100%に設定 */
    max-width: 540px; /* コンテナの最大幅を540pxに制限 */
    margin: 0 auto; /* 上下の余白を0、左右の余白を自動調整して中央揃え */
    padding: 12px 24px; /* 内側の余白を上下12px、左右24pxに設定 */
}

/* フォトコンテンツのスタイリング */
.photo-content {
    display: flex; /* フレックスボックスモデルを使用してアイテムを配置 */
    width: 100%; /* コンテナの幅を親要素の100%に設定 */
}

/* フォトテキストエリアのスタイリングを調整 */
.photo-text {
    flex: 1; /* フレックスアイテムを利用可能なスペースに応じて伸縮させる */
}

/* フォトイメージコンテナのスタイリングを調整 */
.photo-image-container {
    flex: 1; /* フレックスアイテムを利用可能なスペースに応じて伸縮させる */
    display: flex; /* フレックスボックスモデルを使用してアイテムを配置 */
    justify-content: center; /* アイテムをコンテナの中央に揃える */
}

/* フォトイメージのスタイリング */
.photo-image {
    max-width: 100%; /* イメージの最大幅を親要素の幅の100%に設定 */
    height: auto; /* イメージの高さを自動調整してアスペクト比を維持 */
    border-radius: 0.375rem; /* イメージの角を丸くするためのボーダー半径を設定 */
}

/* 見出しのスタイリング */
.photo-title {
    font-size: 1.5rem; /* 2xlに相当 */
    font-weight: bold; /* 太字 */
    margin-bottom: 0.5rem; /* 下のマージン */
}
</style>
