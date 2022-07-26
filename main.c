/*
#include <stdio.h>
#include <string.h>

struct vector{
    int x;
    int y;
};

int main()
{
    struct vector v1,v2;
    v1.x=10;
    v1.y=24;

    v2.x=15;
    v2.y=20;

    printf("X coordinate is %d, Y coordinate is %d",v1.x,v1.y);
    return 0;
}
*/
#include <stdio.h>
#include <string.h>

struct vector{
    int x;
    int y;
};

struct vector sumVector(struct vector v1,struct vector v2){
    struct vector v3;
    v3.x = v1.x + v2.x;
    v3.y = v1.y + v2.y;
    return v3;
}


int main()
{
    struct vector v1,v2,sum;
    v1.x=10;
    v1.y=24;

    v2.x=15;
    v2.y=20;
    sum=sumVector(v1,v2);

    printf("Sum of x dim of vectors is %d\nSum of y dim of vectors is %d",sum.x,sum.y);

    return 0;
}
