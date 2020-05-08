function confirmation(){
    close = false;
    if (confirm("Czy na pewno chcesz usunąć tę ocenę?")) {
      close = true;
    }
    return close;
}