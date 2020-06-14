<template>
    <div class="conversation">
        <h1>{{contact.name}}</h1>
            <message-feed :messages="messages" :contact="contact"/>
            <message-composer @send="sendMessage"/>
    </div>
</template>
<script>
import MessageComposer from './MessageComposer'
import MessageFeed from './MessageFeed'
export default {
    components:{
        'message-composer':MessageComposer,
        'message-feed':MessageFeed
    },
    props:{
        contact:{
            type:Object,
            default:null
        },
        messages:{
            type:Array,
            default:[]
        }
    },
    methods:{
        sendMessage(text){
            axios.post('api/conversation/send',{
                text:text,
                to:this.contact.id
            }).then(response=>{
                this.$emit('newMessage',response.data);
            }).catch(error=>{

            });
        }
    }
}
</script>
<style lang="scss">
    .conversation{
        overflow:hidden;
    }
</style>