import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import { Observer } from 'rxjs/Observer';

import * as socketIo from 'socket.io-client';
import { CommunicationSocketConnectInterface } from '../interfaces/communication.interface';
import { webSocket } from 'rxjs/webSocket';
import { map, share } from 'rxjs/internal/operators';
import {BehaviorSubject} from 'rxjs/Rx';


@Injectable()
export class SocketService {
  private inboundSocket;
  private outboundSocket;

  test: BehaviorSubject<any> = new BehaviorSubject<any>(null);

  public initSocket(data: CommunicationSocketConnectInterface) {
    this.inboundSocket = new WebSocket(`${data.url}/topic/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`);

    if (data.outbound) {
      this.outboundSocket = new WebSocket(`${data.url}/app/chatMessage.new?user=${data.userName}&uuid=${data.uuid}`);
    }


    this.inboundSocket.onopen = () => {
      console.log("WebService Connected to inboundsock");


    };

    if (data.outbound) {
      this.outboundSocket.onopen = () => {
        console.log("WebService Connected to inboundsock");
      };
    }

      this.inboundSocket.onmessage = (event) => {
        if (!event || !event.data) {
          return;
        }

        this.test.next(JSON.parse(event.data));
      }
  }

  public sendMessage(data: string): void {
    this.outboundSocket.send(data);
  }

  public checkStatus(data: any): Observable<any> {
    return Observable.create(observer => {
      observer.next(this.test.getValue())
    })
  }

}
