<template>
    <div class="chat-app">
        <conversation :contact="selectedContact" :messages="messages" @newMessage="updateMessages" /> 
        <contactsList :contacts="contacts" @selected="chatWith"/>
    </div>
</template>

<script>
    import conversation from './Conversation';
    import contactsList from './ContactsList';
    export default {
        components:{conversation,contactsList},
        data(){
            return{
                selectedContact:null,
                messages:[],
                contacts:[]
            }
        },
        props:{
            user:{
                type:Object,
                required:true
            }
        },
        created() {
            Echo.private(`messages.${this.user.id}`).listen('newMessage',(e)=>{
                this.handleIncoming(e.msg);
            });
            axios.get('/api/contacts').then(response=>{
                this.contacts=response.data;
                    this.selectedContact=this.contacts[0];
                    this.chatWith(this.selectedContact);
            
            }).catch(error=>{
                console.log(error);
            })
        },
        methods:{
            chatWith(contact){
                axios.get(`/api/conversation/${contact.id}`).then(response=>{
                this.selectedContact=contact;
                this.messages=response.data; 
                }).catch(error=>{
                console.log(error);
                })
            },
            updateMessages(newMsg){
                this.messages.push(newMsg);
            },
            handleIncoming(msg){
                if(this.selectedContact.id===msg.from){
                    this.updateMessages(msg);
                    return;
                }
                alert(msg.text);
            }
        }
    }
</script>
<style lang="scss" scoped>
    .chat-app{
        display: flex;
        height:80vh;
        .conversation{
            flex:1;
            display: flex;
            flex-direction: column;
        }
        .contacts-list{
            overflow-x:auto;
        }
    }
</style>