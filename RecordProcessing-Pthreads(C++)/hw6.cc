//
// hw4.cc
//
// Author: Wininger, Jarred
// Date  : 02/25/2016
// Edited: 03/23/2016
// Read in product record, display record, and output to file.
//	Use pThreads


#include <string>	// C++ string class
#include <iostream>	//C++ keyboard and screen i/o
#include <vector>	//One of the C++ STL classes
#include <fstream>	//C++ file i/o
#include <string.h>	//C strings
#include <stdlib.h>	//C standard Library
#include <limits>
#include <iomanip>
#include <unistd.h>
#include <semaphore.h>
#include <pthread.h> 
#include <queue>


#ifndef product_record
#include "SafeQueue.h"
#include "product_record.h"
#include "hw1.h"
#endif

using namespace std;

//GLOBAL VARIABLES

SafeQueue SafeQ[6];







/*
 * Takes command line arguments for input and output file
 * then reads in record, stores it, prints out record, then writes it to outfile.
 *
 * @param int argc
 * @param char** argv
 */
int main( int argc, char** argv ) {
    	product_record rec;
	string input = "";		//input string
	string output = "";		//output string
	string trash = "";		//string for Press Key To Continue
	pthread_t st0,st1,st2,st3,st4,readInTh,outThread;


	//check for correct command line parameters
	if(argc !=3)
	{
		cout<<"INCORRECT NUMBER OF PARAMETERS"<<endl;
		
	}
	else 
	{
	//get input file
	input = argv[1];
	void *p=&input;
	

	//get output file
	output = argv[2];
	//create pthreads for stations, reading in the file, and writing out the file
	if( pthread_create(&readInTh,NULL, readInFile, (void *)&input) < 0)
	{	
		cout << "ERROR: readInTh"<<endl;
	}
	if( pthread_create(&st0,NULL, station0, NULL) < 0)
	{	
		cout << "ERROR: s0 " << endl;
	}
	if( pthread_create(&st1,NULL, station1, NULL) < 0)
	{	
		cout << "ERROR: s1 " << endl;
	}
	if( pthread_create(&st2,NULL, station2, NULL) < 0)
	{	
		cout << "ERROR: s2 " << endl;
	}	
	if( pthread_create(&st3,NULL, station3, NULL) < 0)
	{	
		cout << "ERROR: s3 " << endl;
	}	
	if( pthread_create(&st4,NULL, station4, NULL) < 0)
	{	
		cout << "ERROR: s4 " << endl;
	}	

	if( pthread_create(&outThread,NULL, writeOutRecord, (void *)&output) < 0)
	{	
		cout << "ERROR: outThread " << endl;
	} 	
	
	//wait for pthreads to exit
	pthread_join(readInTh, NULL);
	pthread_join(st0,NULL);
	pthread_join(st1,NULL);
	pthread_join(st2,NULL);
	pthread_join(st3,NULL);
	pthread_join(st4,NULL);
	pthread_join(outThread,NULL);

	return 0;
	}
}

/*reads in the record and processes it
 *
 * @param void *inputFile, void cast string for input file
 * 
 */
void *readInFile(void *inputFile)
{
	product_record rec;	//product record to store values in
	fstream fsIn;	//fstrems to write in 
	string *nput= static_cast<string*>(inputFile);
	string input = *nput;

	fsIn.open(input.c_str(), ios::in);
	if(fsIn.is_open())
	{
        	while( fsIn >> rec.idnumber )
		{
			//read product name
			fsIn >> rec.name;
			//read price
			fsIn >> rec.price;
			//read quantity ordered
			fsIn >> rec.number;
			//read tax
			fsIn >> rec.tax;
			//read shipping and handling cost
			fsIn >> rec.sANDh;
			//read order total
			fsIn >> rec.total;
			//initialize stations processed
			for ( int i =0; i< MAXSTAGES; i++)
			{
				fsIn  >> rec.stations[i];
			}

			//enqueue SafeQueue for Station 0
			SafeQ[0].enqueue(rec);

		}
		//send out termination record
		rec.idnumber = -1;
		//enqueue SafeQueue for Station 0
		SafeQ[0].enqueue(rec);

		fsIn.close();


	}
	else
	{
		cout << "ERROR: File Not Open . . ." <<endl;
	}
	pthread_exit(0);
	


}//end readInFile


/*first station (0)
 * Computes tax
 *
 *
 *
 */
void* station0(void *param)
{
	while(true)
	{
		double tax;		//tax variable
		
		//get PR from SafeQueue
		product_record product_rec=SafeQ[0].dequeue();
		
		//if termination record, send to next queue and exit thread
		if(product_rec.idnumber == -1)
		{
			//Send to SafeQueue for Station 1
			SafeQ[1].enqueue(product_rec);
			pthread_exit(0);
		}
		//calculate tax, set station processed, and send to next queue
		product_rec.tax = (product_rec.number*product_rec.price*.05);
		product_rec.stations[0] = 1;
		if(product_rec.number < 1000)
		{
			//Send to SafeQueue for Station 1
			SafeQ[1].enqueue(product_rec);
			
		}
		else
		{
			//Send to SafeQueue for Station 2
			SafeQ[2].enqueue(product_rec);
			
		}

	}
}

/*second station (1)
 * Computes Shipping and Handling
 *
 *
 *
 */
void* station1(void *param)
{
	while(true)
	{
		
		//get PR off SafeQueue
		product_record product_rec=SafeQ[1].dequeue();
		
		//if termination record, send to next queue and exit thread
		if(product_rec.idnumber == -1)
		{
			//Send to SafeQueue for Station 2
			SafeQ[2].enqueue(product_rec);
			pthread_exit(0);
		}
		//calculate shipping and handling, then add to next stations queue
		product_rec.sANDh = (10+(.01*product_rec.number*product_rec.price));
		product_rec.stations[1]=1;
		//Send to SafeQueue for Station 2
		SafeQ[2].enqueue(product_rec);
	}
}

/*third station (2)
 * Computes order total
 *
 *
 *
 */
void* station2(void *param)
{
	while(true)
	{
		
		//get PR off queue
		product_record product_rec=SafeQ[2].dequeue();
		
		//if termination record, send to next queue and exit thread
		if(product_rec.idnumber == -1)
		{
			//Send to Station 3 SafeQueue
			SafeQ[3].enqueue(product_rec);
			pthread_exit(0);
		}
		//calculate order total, send to next queue
		product_rec.total = (product_rec.sANDh+product_rec.tax+(product_rec.number*product_rec.price));
		product_rec.stations[2]=1;
		//Send to Station 3 SafeQueue
		SafeQ[3].enqueue(product_rec);
	}
}

/*fourth station (3)
 * Computes and displays running total of all orders seen so far
 *
 *@param (void*)product_rec, product record to process
 *
 */
void* station3(void *param)
{
	double running_total=0;
	while(true)
	{
		
		//get PR off queue
		product_record product_rec=SafeQ[3].dequeue();
		
		//if termination record, send to next queue and exit thread
		if(product_rec.idnumber == -1)
		{
			SafeQ[4].enqueue(product_rec);
			pthread_exit(0);
		}
		//calculate and display running total
		running_total += product_rec.total;
		cout << "Running Total: $"<< running_total << endl;

		product_rec.stations[3] = 1;
		//send to next queue
		SafeQ[4].enqueue(product_rec);
	}
}

/*fifth station (4)
 * Displays the record on the screen
 *
 *@param (void*)product_rec, product record to process
 *
 */
void* station4(void *param)
{
	while(true)
	{

		//get PR off queue
		product_record rec=SafeQ[4].dequeue();
		
		//if termination record, send to next queue and exit thread
		if(rec.idnumber == -1)
		{
			SafeQ[5].enqueue(rec);
			pthread_exit(0);
		}
		rec.stations[4]=1;
		//Print out record
		std::cout << std::fixed << std::setprecision(2);
		cout << "Product ID:	 " << rec.idnumber << endl;
		cout << "Product Name:	 " << rec.name << endl;
		cout << "Product Price 	" << rec.price << endl;
		cout << "Quantity: 	" << rec.number << endl;
		cout << "Order Tax: 	" << rec.tax << endl;
		cout << "S&H:		" << rec.sANDh << endl;
		cout << "Order Total: 	" << rec.total << endl;
		cout << "Stations: 	" << rec.stations[0] << " " << rec.stations[1] << " " << rec.stations[2] << " " << rec.stations[3] << " " << rec.stations[4] << endl;
		//send to next queue
		SafeQ[5].enqueue(rec);
	}
}



/*writes record to the output file.
 *
 * @param string& output, name of the output file
 * @param product_record rec, record to write out
 */
void* writeOutRecord(void *outputFile)
{
	while(true)
	{
		product_record rec = SafeQ[5].dequeue();
		fstream fOut;	//fstream for writing out
		string *oput= static_cast<string*>(outputFile);
		string output = *oput;
		
		
		//if termination record, exit thread
		if(rec.idnumber == -1)
		{
			pthread_exit(0);
		}
		fOut.open(output.c_str(), ios::out | ios::app );
		fOut << fixed << setprecision(2);
		//write record to output file
		fOut << rec.idnumber << endl;
		fOut << rec.name << endl;
		fOut << rec.price << endl;
		fOut << rec.number << endl;
		fOut << rec.tax << endl;
		fOut << rec.sANDh << endl;
		fOut << rec.total << endl;
		fOut << rec.stations[0] << " " << rec.stations[1] << " " << rec.stations[2] << " " << rec.stations[3] << " " << rec.stations[4] << endl;
		fOut.close();
	}
}








