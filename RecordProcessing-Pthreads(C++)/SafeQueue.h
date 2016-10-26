/**********************************************
*	Author: Jarred Wininger
*	Date:	04/22/2016
*	File:	SafeQueue.h
**********************************************/

#ifndef SAFEQUEUE_H
#define SAFEQUEUE_H



#include <stdlib.h>	//C standard Library
#include <semaphore.h>
#include <pthread.h> 
#include <queue>

#ifndef product_record
#include "product_record.h"
#endif

using namespace std;

class SafeQueue {

private:
	//queue for product records
	queue<product_record> PRQueue;
	//semaphore to check if queue is empty	
	sem_t PRSem;
	//locks Critical Region
	pthread_mutex_t stationLock;
public:
	//Default Constructor
	SafeQueue();

	//Enqueue Function
	void enqueue(product_record m);

	//Dequeue Function
	product_record dequeue();

};	//Safequeue

#endif
