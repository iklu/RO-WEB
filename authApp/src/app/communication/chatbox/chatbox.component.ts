import { Component } from '@angular/core';
import { CommunicationConstants } from '../interfaces/communication.constants';
import { CommunicationSocketConnectInterface } from '../interfaces/communication.interface';
import { WebSocketSubject, webSocket } from 'rxjs/websocket';
import {SocketService} from '../services/plugInSocket.service';

@Component({
  selector: 'chatbox',
  templateUrl: './chatbox.component.html',
  styleUrls: ['./chatbox.component.scss']
})

export class ChatboxComponent {
  isLogged: boolean = false;

  socket: any;
  outbound: any;
  inboud: any;
  inboudSocket: any;
  credentials: CommunicationSocketConnectInterface;

  chatboxUsername: string = '';
  chatboxPassword: string = '';
  chatboxMessageCollector: any = [];
  chatboxMessage: string = '';

  constructor(private socketOne: SocketService) {

  }

  checkLoginStatus(event) {

    this.credentials = event;

    this.socketOne.initSocket({
      uuid: this.create_UUID(),
      userName: event.userName,
      url: CommunicationConstants.CHATBOX_SOCKET_URL
    }).subscribe((event) => {
    });

    this.socketOne.initSocket({
      uuid: this.create_UUID(),
      userName: event.userName,
      url: CommunicationConstants.CHATBOX_SOCKET_URL,
      outbound: true
    }).subscribe((event) => {
      if (!event) {
        return;
      }

      event.isOwner = this.credentials.userName === event.payload.user.alias;

      console.log(event);

      this.chatboxMessageCollector.push(event);

    })




    // this.socketOne.initSocket(CommunicationConstants.CHATBOX_SOCKET_URL, {
    //   user: event.userName,
    //   uuid: this.create_UUID()
    // });
    // console.log('test', this.socketOne);
    //
    // if (!event ||
    //     !event ||
    //     !event.access_token ||
    //     event.error) {
    //  console.log('ERROR ON CHATBOX LOGIN!?', event);
    //
    //  return;
    // }
    //
    // this.isLogged = true;
    //
    // this.credentials = {
    //   uuid: this.create_UUID(),
    //   userName: event.userName,
    //   url: CommunicationConstants.CHATBOX_SOCKET_URL
    // };
    //
    // this.plugSocket(this.credentials);
    //
    // // console.log(this.credentials);
    // //
    //
    // // console.log(this.create_UUID(), CommunicationConstants.CHATBOX_SOCKET_URL);
  }

  plugSocket(data: CommunicationSocketConnectInterface) {
    if (!data.url||
        !data.userName ||
        !data.uuid) {
      console.log('Error on plugging socket');
      return;
    }

    alert();

    this.outbound = webSocket(`${data.url}/app/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`);
    this.outbound.subscribe(
      (msg) => console.log('message received: ' + msg),
      (err) => console.log(err),
      () => console.log('complete')
    );

    this.inboud = webSocket(`${data.url}/topic/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`);
    this.inboud.subscribe(
      (msg) => console.log('message received: ' + msg),
      (err) => console.log(err),
      () => console.log('complete')
    );



    // this.socket = new WebSocket(`${data.url}/app/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`);
    // this.inboudSocket = new WebSocket(`${data.url}/topic/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`);
    //
    // this.webSocketService.plugInSocket(`${data.url}/app/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`).subscribe(message => {
    //   this.webSocketService.plugInSocket(`${data.url}/topic/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`).subscribe(aaa => {
    //     console.log(aaa);
    //     alert();
    //   })
    // })
    //
    // this.socket.onopen = (event) => {
    //   this.socket.socketIsPlugged = true;
    // }
  }

  sendMessage() {

    this.socketOne.sendMessage(JSON.stringify({
      "type": "CHAT_MESSAGE",
      "payload": {
        "user": {
          "alias": this.credentials.userName,
          "avatar": "https://robohash.org/" + this.credentials.userName + ".png"
        },
        "message": this.chatboxMessage
      }
    }));


    // this.socket.send(JSON.stringify({
    //   "type": "CHAT_MESSAGE",
    //   "payload": {
    //     "user": {
    //       "alias": this.credentials.userName,
    //       "avatar": "https://robohash.org/" + this.credentials.userName + ".png"
    //     },
    //     "message": this.chatboxMessage
    //   }
    // }));

    // this.inboudSocket.onmessage = (event) => {
    //   console.log('event', event);
    // }
  }

  disconnectSocket(token?: string) {

  }


  create_UUID() {
    let dt = new Date().getTime();
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
      let r = (dt + Math.random() * 16) % 16 | 0;
      dt = Math.floor(dt / 16);
      return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
  }
}
