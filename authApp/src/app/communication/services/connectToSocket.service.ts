import { Injectable } from '@angular/core';
import {Observable, Observer, Subject} from "rxjs";
import { catchError } from "rxjs/operators";
import { of } from "rxjs/internal/observable/of";

@Injectable()

export class ConnectToSocketService {
  private subject: Subject<MessageEvent>;
  private ws: any;
  public message: Subject<any> = new Subject<any>();

  public plugInSocket(url: string): Subject<MessageEvent> {
    if (!this.subject) {
      this.subject = this.connectToSocket(url)
    }

    return this.subject;
  }

  public connectToSocket(url: string): Subject<MessageEvent> {
    this.ws = new WebSocket(url);

    let observable = Observable.create(
      (obs: Observer<MessageEvent>) => {
        this.ws.onmessage = obs.next.bind(obs);
        this.ws.onerror   = obs.error.bind(obs);
        this.ws.onclose   = obs.complete.bind(obs);

        return this.ws.close.bind(this.ws);
      });

    let observer = {
      next: (data: Object) => {
        if (this.ws.readyState === WebSocket.OPEN) {
          this.ws.send(JSON.stringify(data));
        }
      }
    };

    return Subject.create(observer, observable);
  }

  public close() {
    console.log('on closing WS');
    this.ws.close();
    this.subject = null;
  }
}
