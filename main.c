#include <stdio.h>

typedef struct complex_no{
    int real;
    int imag;
}comp;

void display(comp c){
    printf("The complex number is %d + i(%d)\n",c.real,c.imag);
}


int main()
{
    comp c[5];
    int j=0;
    for(int i=1; i<=5; i++){
        printf("Enter the real part of complex number %d: ",i);
        scanf("%d",&c[j].real);
        printf("Enter the imaginary part of complex number %d: ",i);
        scanf("%d",&c[j].imag);
        j++;
    }
    for(int i=0; i<5; i++){
        display(c[i]);
    }
    printf("i love u");

    return 0;
}
