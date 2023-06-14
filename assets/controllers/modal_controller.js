import { Controller } from '@hotwired/stimulus';
import { Modal } from 'bootstrap';
import * as Turbo from '@hotwired/turbo';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class ModalController extends Controller {
    static targets = ['src']

    connect() {
        this.modal = new Modal(this.element);
    }

    openFrame(event) {
        this.srcTarget.setAttribute('src', event.detail.src);
        this.modal.show();
    }

    beforeFetchResponse(event) {
        if (!this.modal || !this.modal._isShown) {
            return;
        }

        const fetchResponse = event.detail.fetchResponse;
        if (fetchResponse.succeeded && fetchResponse.redirected) {
            event.preventDefault();
            Turbo.visit(fetchResponse.location);
        }
    }
}
