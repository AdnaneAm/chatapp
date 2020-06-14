<template>
    <div class="composer">
        <input v-model="message" @keydown.enter="send" placeholder="Message .."></input>
    </div>
</template>
<script>
export default {
    data(){
        return{
            message:''
        }
    },
    methods:{
        send(e){
            e.preventDefault();
            if(this.message==''){
                return;
            }
            this.$emit('send',this.message);
            this.message='';
        }
    }
}
</script>
<style lang="scss">
    .composer{
        input{
            width: 94%;
            border: none;
            resize: none;
            padding: .9em 1.5em;
            background: #f7f7f7;
            color: black;
            font-weight: 500;
            border-radius: 2em;
            margin: 2% 3%;
            font-size: 16px;
            &:focus{
                border:none;
                outline:none;
                background: #f1f3fc;
            }
        }
    }
</style>