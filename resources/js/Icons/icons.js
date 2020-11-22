import Vue from 'vue';
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import FormatBoldIcon from 'vue-material-design-icons/FormatBold.vue'
import FormatItalicIcon from 'vue-material-design-icons/FormatItalic.vue'
import FormatParagraphIcon from 'vue-material-design-icons/FormatParagraph.vue'
import FormatListBulletedIcon from 'vue-material-design-icons/FormatListBulleted.vue'
import FormatListNumberedIcon from 'vue-material-design-icons/FormatListNumbered.vue'
import CodeBracesIcon from 'vue-material-design-icons/CodeBraces.vue'
import ImageIcon from 'vue-material-design-icons/Image.vue'
import MinusIcon from 'vue-material-design-icons/Minus.vue'
import UndoIcon from 'vue-material-design-icons/Undo.vue'
import RedoIcon from 'vue-material-design-icons/Redo.vue'
import ChevronLeftIcon from 'vue-material-design-icons/ChevronLeft.vue'
import ViewGridIcon from 'vue-material-design-icons/ViewGrid.vue'
import ViewListIcon from 'vue-material-design-icons/ViewList.vue'
import PencilIcon from 'vue-material-design-icons/Pencil.vue'
import CheckCircleIcon from 'vue-material-design-icons/CheckCircle.vue'

export default function() {
  Vue.component('menu-icon', MenuIcon);
  Vue.component('format-bold-icon', FormatBoldIcon);
  Vue.component('format-italic-icon', FormatItalicIcon);
  Vue.component('format-paragraph-icon', FormatParagraphIcon);
  Vue.component('format-list-bulleted-icon', FormatListBulletedIcon);
  Vue.component('format-list-numbered-icon', FormatListNumberedIcon);
  Vue.component('code-braces-icon', CodeBracesIcon);
  Vue.component('image-icon', ImageIcon);
  Vue.component('minus-icon', MinusIcon);
  Vue.component('undo-icon', UndoIcon);
  Vue.component('redo-icon', RedoIcon);
  Vue.component('chevron-left-icon', ChevronLeftIcon);
  Vue.component('view-grid-icon', ViewGridIcon);
  Vue.component('view-list-icon', ViewListIcon);
  Vue.component('pencil-icon', PencilIcon);
  Vue.component('check-circle-icon', CheckCircleIcon);
}
