import { reactive } from "vue";

export const guide = reactive({
  open: false,
});

export function openGuide() {
  guide.open = true;
}
