import {config, library, dom} from '@fortawesome/fontawesome-svg-core';
config.autoReplaceSvg = 'nest';
import{
    faCaretUp,
    faCaretDown,
    faStar,
    faCheck,
    faThumbsUp,
    faThumbsDown,
    faEye,
    faCommentDots
} from '@fortawesome/free-solid-svg-icons';

library.add(faCaretDown, faCaretUp, faStar, faCheck, faThumbsUp, faThumbsDown, faEye, faCommentDots);
dom.watch();
