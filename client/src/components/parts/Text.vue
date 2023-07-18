<script setup >
// import strapiService from '../api/strapiService';

</script>

<template>
    <div class="container" :class="this.getAlignment()">
        <h2>{{ this.data.Title }}</h2>
        <span v-html="this.data.Text" class="text">
        </span>
    </div>
</template>
  
<script>

export default {
    name: 'Text',

    props: {
        data: Object
    },

    data() {
        return {
            alignment: '',
        };
    },

    created() {
        this.alignment = this.data.Size;
        console.log(this.getAlignment());
    },

    methods: {
        getAlignment() {
            switch (this.alignment) {
                case 'Links uitgelijnd':
                    return 'left';
                case 'Rechts uitgelijnd':
                    return 'right';
                case 'Midden uitgelijnd':
                    return 'center';
                default:
                    return 'left';
            }
        },
    }
};
</script>

<style scoped lang="scss">


.text {
    font-size: 20px;
    line-height: 1.5;
}

// allignments
.container {

    display: flex;
    flex-direction: column;
    margin-bottom: var(--section-spacing);

    &.left {
        align-items: flex-start;
        text-align: left;
    }

    &.right {
        align-items: flex-end;
        text-align: right;
    }

    &.center {
        align-items: center;
        text-align: center;
        max-width: 600px;
    }
}
</style>
  