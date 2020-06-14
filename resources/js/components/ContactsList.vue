<template>
    <div class="contacts-list">
        <ul>
            <li v-for="(contact,index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'selected':index===selected}">
                <div class="avatar">
                    {{contact.name[0]}}
                </div>
                <div class="contact">
                    <p class="name">{{contact.name}}</p>
                    <p class="email">{{contact.email}}</p>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data(){
        return{
            selected:0
        }
    },
    props:{
        contacts:{
            type:Array,
            default:[]
        }
    },
    methods:{
        selectContact(index,contact){
            this.selected=index;
            this.$emit('selected',contact);
        }
    }
}
</script>
<style lang="scss">
    .contacts-list{
        border-left: 2px solid #f1f1f1;
        ul{
            padding:0;
            li{
                list-style: none;
                display: flex;
                padding: 0.7em .9em;
                border-bottom:2px solid whitesmoke;
                transition:.1s all ease-in-out;
                cursor:pointer;
                &:hover{
                    background:rgb(245, 245, 245);
                }
                .avatar{
                    width: 40px;
                    height: 40px;
                    background:rgb(25, 131, 252);
                    text-align: center;
                    line-height: 32px;
                    border-radius: 50%;
                    border: 4px solid #e7e7e7;
                    color: white;
                    font-weight: bold;
                    font-size: 14px;
                }
                .contact{
                    margin-left: 1em;
                    .name{
                        margin-bottom: 0.1em;
                        font-weight: 600;
                        font-family: Open Sans;
                        letter-spacing: -0.6px;                            
                    }
                    .email{
                        color: #bfbfbf;
                        font-weight: 500;
                        margin-bottom: 0;
                    }
                }
            }
            li.selected{
                border-right: 5px solid #1882fc;
                background: #fafbff;
            }
        }
    }
</style>