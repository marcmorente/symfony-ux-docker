import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class ButtonController extends Controller {
    openModalFrame(event) {
        this.dispatch('open:modal:frame', { detail: {src: event.target.dataset.src} });
    }
}
