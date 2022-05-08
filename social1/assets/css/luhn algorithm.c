#include <stdio.h>

int main()
{
    int i;
    int m=0;
      int k = 0;
    int sum=0;
    int n;
       int l = 0;
    int j=0;
    int a[16],b[7],c[7],d[11];
    printf("enter the first 15 digits of your credit card or debit card\n");
    for( i=0;i < 15; i++)
    {
        scanf("%d",&a[i]);
    }
    for( i = 0; i < 15;  i++)
    {
        if(i%2 != 0)  {
        //for(int j=0; j < 5; j++)
        
        b[j] = a[i] * 2;
        j++;
        }
    }
    for( i = 0 ; i < 7 ; i++ )
    {
        printf(" %d ",b[i]);
        
    }
    printf(" \n");
    for(i = 0; i < 7; i++)
    {
        if(b[i] > 9)
        {
            n=b[i];
            while(n  > 0)
           {    
        m=n%10;    
        sum=sum+m;    
        n=n/10;    
        }   
        c[i] = sum;
        sum = 0;
        m = 0;
        n = 0;
        
           /* int e = b[i];
            int f = e/10;
            float g = e/10;
            float h = g-1;
            int n = h*10;
            c[i] = n + f; */
               
       
        }else
        c[i] = b[i];
        }
        for( i = 0 ; i < 7 ; i++)
        {
            printf(" %d ",c[i]);
        }
        
        for(i = 0 ; i < 11 ; i=i+2)
        {
          
            k = k + a[i];
        }
        for(i = 0 ; i < 7 ; i++)
        {
         
            l = l + c[i];
        }
        int z;
         z = l + k;
        printf("%d",z);
        printf(" \n");
        int x = (z*9)%10 + z;
        
        if(x%10 == 0)
        printf(" valid card\n");
        else
        printf("its not a valid card\n");
}
