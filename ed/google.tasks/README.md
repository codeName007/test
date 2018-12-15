Tasks
-

[docs](https://cloud.google.com/tasks/docs/)

````bash
gcloud beta tasks queues list

gueueName=parse-product

gcloud beta tasks queues create-app-engine-queue $gueueName
gcloud beta tasks queues describe $gueueName

curl 'https://cloudtasks.googleapis.com/$discovery/rest?version=v2beta3' | jq

# queues list
curl 'https://cloudtasks.googleapis.com/v2beta3/projects/prj/locations/us-central1/queues'
````

https://cloud.google.com/tasks/docs/dual-overview