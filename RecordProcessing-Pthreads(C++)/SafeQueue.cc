/**********************************************
*	Author: Jarred Wininger
*	Date:	04/22/2016
*	File:	SafeQueue.cc
**********************************************/

#include <stdlib.h>	//C standard Library
#include <semaphore.h>
#include <pthread.h> 
#include <queue>

#ifndef SAFEQUEUE_H
#include "SafeQueue.h"
#include "product_record.h"
#endif


// Default Constructor
SafeQueue::SafeQueue() {
	
	//sem_t PRSem;
	
	pthread_mutex_unlock(&stationLock);
}// SafeQueue()

//Enqueue
//	Pushes PR onto queue. 
//	Protect access with mutex and semaphore
void SafeQueue::enqueue(product_record m)
{
	//Lock the queue
	pthread_mutex_lock(&stationLock);
	//add PR to queue
	PRQueue.push(m);
	//unlock queue
	pthread_mutex_unlock(&stationLock);
	//increment semaphore
	sem_post(&PRSem);

}// Enqueue(product_record)

//Dequeue
//	Wait on sem then pop the PR from queue
//	Protect with mutex
//
product_record SafeQueue::dequeue() 
{
	//wait for semaphore > 0
	sem_wait(&PRSem);
	//lock queue
	pthread_mutex_lock(&stationLock);
	//pop from queue
	product_record rec = PRQueue.front();
	PRQueue.pop();
	//unlock queue
	pthread_mutex_unlock(&stationLock);
	//return record
	return rec;

}// Dequeue(product_record)
