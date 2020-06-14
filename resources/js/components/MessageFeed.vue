<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to==contact.id?'sent':'received'}`" :key="message.id">
                <div class="text">
                    {{message.text}}
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props:{
        messages:{
            type:Array,
            required:true
        },
        contact:{
            type:Object,
            default:null
        }
    },
    methods:{
        scrollToBottom(){
            let feedRf=this.$refs.feed;
            setTimeout(()=>{
                feedRf.scrollTop=feedRf.scrollHeight-feedRf.clientHeight;
            },50)
        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom();
        },
        messages(messages){
            this.scrollToBottom();
        }
    }
}
</script>
<style lang="scss">
    @mixin chat-bubble{
        list-style: none;
        font-weight: 600;
        padding: 0.8em 1.2em;
        margin-bottom:.5em;
    }
    .feed{
        flex:1;
        overflow-y:auto;
        ul{
            display:flex;
            flex-direction: column;
            padding:0 1em;
            li{
                @include chat-bubble();
            }
            li.messagesent{
                border-radius: 2em 0 1.6em 2em;
                background: #1983fc;
                align-self: flex-end;
                color:white;
            }
            li.messagereceived{
                border-radius: 0 2em 2em 1.6em;
                background: #eaeaea;
                align-self: flex-start;
            }
        }
    }
</style>